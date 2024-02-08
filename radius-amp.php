<?php
/**
 * Plugin Name: Radius AMP
 * Plugin URI: https://radiustheme.com/
 * Description: Provides AMP support for awesome mobile page view experience.
 * Author: RadiusTheme
 * Version: 1.0.0
 * Author URI: www.radiustheme.com
 * Text Domain: radius-amp
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Defining Constants.
 */
define( 'RT_AMP_VERSION', '1.0.0' );
define( 'RT_AMP_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'RT_AMP_PLUGIN_ACTIVE_FILE_NAME', __FILE__ );
define( 'RT_AMP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'RT_AMP_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

$theme = wp_get_theme()->get( 'Name' );

if ( ! ( 'Neeon' === $theme || 'Neeon Child Theme' === $theme ) ) {
	add_action( 'admin_notices', 'rttlp_amp_theme_not_found' );

	return;
}

if ( ! class_exists( AMP_Post_Template::class ) ) {
	add_action( 'admin_notices', 'rttlp_amp_plugin_not_found' );

	return;
}

/**
 * Admin notice for theme requirement.
 *
 * Warns user when Neeon theme is not activated.
 *
 * @since 1.0.0
 * @return void
 */
function rttlp_amp_theme_not_found() {
	$message      = __( 'Radius AMP plugin requires <b>Neeon Theme</b>. Please install and activate <b>Neeon Theme</b> to use Radius AMP features.', 'radius-amp' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

/**
 * Admin notice for plugin requirement.
 *
 * Warns user when AMP plugin is not activated.
 *
 * @since 1.0.0
 * @return void
 */
function rttlp_amp_plugin_not_found() {
	$message      = __( 'Radius AMP plugin requires <b>AMP plugin</b>. Please install and activate <b>AMP plugin</b> to use Radius AMP features.', 'radius-amp' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

register_activation_hook( __FILE__, 'activate_rttlp_amp' );
/**
 * Plugin activation action.
 *
 * Plugin activation will not work after "plugins_loaded" hook
 * that's why activation hooks run here.
 */
function activate_rttlp_amp() {
	\RT\Amp\Helpers\Install::activate();
}

register_deactivation_hook( __FILE__, 'deactivate_rttlp_amp' );
/**
 * Plugin deactivation action.
 *
 * Plugin deactivation will not work after "plugins_loaded" hook
 * that's why deactivation hooks run here.
 */
function deactivate_rttlp_amp() {
	\RT\Amp\Helpers\Install::deactivate();
}

/**
 * Include core class.
 */
if ( ! class_exists( 'RttlpAmp' ) ) {
	require_once 'app/RttlpAmp.php';
}

/**
 * Returns RttlpAmp.
 *
 * @return RttlpAmp
 */
function rttlp_amp() {
	return RttlpAmp::get_instance();
}

/**
 * App init.
 */
rttlp_amp()->init( NeeonTheme::class, 'neeon' );
