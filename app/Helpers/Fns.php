<?php
/**
 * Helpers class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Helpers;

/**
 * Helpers class.
 */
class Fns {

	/**
	 * Classes instatiation.
	 *
	 * @param array $classes Classes to init.
	 * @return void
	 */
	public static function instances( array $classes ) {
		if ( empty( $classes ) ) {
			return;
		}

		foreach ( $classes as $class ) {
			$service = $class::get_instance();

			if ( method_exists( $service, 'init' ) ) {
				$service->init();
			}
		}
	}

	/**
	 * Nonce verification.
	 *
	 * @return boolean
	 */
	public static function verifyNonce() {
		$nonce     = isset( $_REQUEST[ self::nonceID() ] ) ? $_REQUEST[ self::nonceID() ] : null;
		$nonceText = self::nonceText();
		if ( ! wp_verify_nonce( $nonce, $nonceText ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Nonce text.
	 *
	 * @return string
	 */
	public static function nonceText() {
		return 'tlp_amp_nonce';
	}

	/**
	 * Nonce ID.
	 *
	 * @return string
	 */
	public static function nonceID() {
		return 'tlp_nonce';
	}

	/**
	 * Render.
	 *
	 * @param string  $view_name View name.
	 * @param array   $args View args.
	 * @param boolean $return View return.

	 * @return string|void
	 */
	public static function render( $view_name, $args = array(), $return = false ) {
		$path = str_replace( '.', '/', $view_name );
		if ( $args ) {
			extract( $args );
		}

		$template = array(
			"radius-amp/{$path}.php",
		);

		if ( locate_template( $template ) ) {
			$template_file = locate_template( $template );
		} else {
			$template_file = rttlp_amp()->templates_path() . $view_name . '.php';
		}

		if ( ! file_exists( $template_file ) ) {
			return;
		}

		if ( $return ) {
			ob_start();
			include $template_file;

			return ob_get_clean();
		} else {
			include $template_file;
		}
	}

	/**
	 * Sanitizes hex color.
	 *
	 * @param string $color Hex color to sanitize.
	 * @return string
	 */
	public static function sanitize_hex_color( $color ) {
		if ( function_exists( 'sanitize_hex_color' ) ) {
			return sanitize_hex_color( $color );
		} else {
			if ( '' === $color ) {
				return '';
			}

			if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
				return $color;
			}
		}
	}

	/**
	 * Convert hexdec color string to rgb(a) string.
	 *
	 * @param string  $color RGB color.
	 * @param boolean $opacity Alpha (Opacity).
	 * @return string
	 */
	public static function hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';

		if ( empty( $color ) ) {
			return $default;
		}

		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		$rgb = array_map( 'hexdec', $hex );

		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) {
				$opacity = 1.0;
			}
			$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
		} else {
			$output = 'rgb(' . implode( ',', $rgb ) . ')';
		}

		return $output;
	}

	/**
	 * Checks for AMP.
	 *
	 * @return bool
	 * @since 1.4.0
	 */
	public static function is_amp_active() {
		return function_exists( 'amp_is_request' ) && amp_is_request();
	}

	/**
	 * Generate a class attribute and an AMP class attribute binding.
	 *
	 * @param string $default Default class value.
	 * @param string $active  Value when the state enabled.
	 * @param string $state   State variable to toggle based on.
	 * @return string HTML attributes.
	 * @since 1.4.0
	 */
	public static function amp_class( $default, $active, $state ) {
		$output = '';

		if ( ! self::is_amp_active() ) {
			return $output;
		}

		$output .= sprintf(
			' [class]="%s"',
			esc_attr(
				sprintf(
					'%s ? \'%s\' : \'%s\'',
					$state,
					$default . ' ' . $active,
					$default
				)
			)
		);

		$output .= sprintf( ' class="%s"', esc_attr( $default ) );
		return $output;
	}

	/**
	 * Add the AMP toggle 'on' attribute.
	 *
	 * @param string $state State to toggle.
	 * @param array  $disable, list of states to disable
	 * @return string The 'on' attribute.
	 * @since 1.4.0
	 */
	public static function amp_toggle( $state = '', $disable = array() ) {
		if ( ! self::is_amp_active() ) {
			return;
		}

		$settings = sprintf(
			'%1$s: ! %1$s',
			esc_js( $state )
		);

		if ( ! empty( $disable ) ) {
			foreach ( $disable as $disableState ) {
				$settings .= sprintf(
					', %s: false',
					esc_js( $disableState )
				);
			}
		}

		return sprintf(
			' on="tap:AMP.setState({%s})"',
			$settings
		);
	}

	/**
	 * AMP Nav Dropdown toggle and class attributes.
	 *
	 * @param string $theme_location Theme location.
	 * @param int    $depth          Depth.
	 * @return string The class and on attributes.
	 */
	public static function amp_nav_dropdown( $theme_location = false, $depth = 0 ) {
		$key = 'nav';
		if ( ! empty( $theme_location ) ) {
			$key .= ucwords( $theme_location );
		}

		global $submenu_index;
		$submenu_index++;
		$key .= 'SubmenuExpanded' . $submenu_index;

		if ( 1 < $depth ) {
			$key .= 'Depth' . $depth;
		}

		return self::amp_toggle( $key ) . self::amp_class( 'has-submenu', 'active', $key );
	}

	public static function nav_menu_args() {
		return array(
			'theme_location' => 'primary',
			'container'      => 'nav',
		);
	}
}
