<?php
/**
 * Install class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Helpers;

/**
 * Install class.
 */
class Install {
	/**
	 * Activation actions.
	 *
	 * @return void
	 */
	public static function activate() {

		$options = get_option( 'amp-options' );

		$options['theme_support']        = 'reader';
		$options['reader_theme']         = 'legacy';
		$options['supported_post_types'] = array( 'post' );
		$options['supported_templates']  = array( 'is_singular' );
		$options['mobile_redirect']      = 1;
		$options['paired_url_structure'] = 'query_var';
		$options['plugin_configured']    = 1;

		unset( $options['all_templates_supported'] );

		update_option( 'amp-options', $options );

		\flush_rewrite_rules();
	}

	/**
	 * Deactivation actions.
	 *
	 * @return void
	 */
	public static function deactivate() {
		\flush_rewrite_rules();
	}
}
