<?php
/**
 * Templates Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers\Frontend;

use RT\Amp\Helpers\Fns;
use RT\Amp\Traits\Singleton;

/**
 * Templates Class.
 */
class Templates {
	use Singleton;

	public function init() {
		if ( ! Fns::is_amp_active() ) {
			return;
		}

		\add_filter( 'amp_post_template_dir', array( $this, 'templates' ) );
		\add_filter( 'amp_post_template_data', array( $this, 'body_class' ) );
		\add_action( 'amp_post_template_head', array( $this, 'favicon' ) );
		\add_filter( 'walker_nav_menu_start_el', array( $this, 'add_dropdown_icons' ), 10, 4 );
	}

	public function templates() {
		return rttlp_amp()->templates_path();
	}

	public function body_class( $amp_data ) {
		$amp_data['body_class'] .= ' radius-amp';

		return $amp_data;
	}

	public function favicon() {
		if ( has_site_icon() ) {
			wp_site_icon();
		}
	}

	/**
	 * Add a dropdown icon to top-level menu items.
	 *
	 * @param string $output Nav menu item start element.
	 * @param object $item   Nav menu item.
	 * @param int    $depth  Depth.
	 * @param object $args   Nav menu args.
	 * @return string Nav menu item start element.
	 */
	public function add_dropdown_icons( $output, $item, $depth, $args ) {
		if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
			return $output;
		}

		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$icon    = '';
			$output .= sprintf(
				'<button' . \RT\Amp\Helpers\Fns::amp_nav_dropdown( $args->theme_location, $depth ) . ' tabindex="-1">%s</button>',
				$icon
			);
		}

		return $output;
	}
}
