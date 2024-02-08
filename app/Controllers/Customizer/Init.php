<?php
/**
 * Customizer init Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers\Customizer;

use RT\Amp\Traits\Singleton;
use RT\Amp\Controllers\Customizer\Settings;

/**
 * Customizer init Class.
 */
class Init {
	use Singleton;

	private $sections;

	private $settings;

	public function init() {
		add_action( 'amp_customizer_register_ui', array( $this, 'remove_controls' ) );
		/**
		 * Registering sections.
		 */
		add_action( 'customize_register', array( $this, 'register' ) );
	}

	public function remove_controls( $wp_customize ) {
		$wp_customize->remove_setting( 'amp_customizer[header_color]' );
		$wp_customize->remove_setting( 'amp_customizer[header_background_color]' );
		$wp_customize->remove_setting( 'amp_customizer[color_scheme]' );
	}

	public function register( $wp_customize ) {
		$this->sections()->settings();

		if ( empty( $this->sections ) || empty( $this->settings ) ) {
			return;
		}

		foreach ( $this->sections as $section => $args ) {
			$wp_customize->add_section( $section, $args );
		}

		foreach ( $this->settings as $setting => $value ) {
			$wp_customize->add_setting(
				$value['id'],
				array(
					'default'           => isset( $value['default'] ) ? $value['default'] : '',
					'transport'         => isset( $value['transport'] ) ? $value['transport'] : '',
					'sanitize_callback' => isset( $value['sanitize_callback'] ) ? $value['sanitize_callback'] : '',
				),
			);

			$wp_customize->add_control(
				new $value['control_class'](
					$wp_customize,
					isset( $value['id'] ) ? $value['id'] : '',
					isset( $value['args'] ) ? $value['args'] : ''
				)
			);
		}
	}

	private function sections() {
		$this->sections['rttlp_amp_header_section'] = array(
			'title'    => __( 'AMP Header', 'radius-amp' ),
			'priority' => 10,
			'panel'    => 'rttheme_header_panel',
		);

		return $this;
	}

	public function settings() {
		$this->settings = Settings::get_instance()->init();

		return $this;
	}
}
