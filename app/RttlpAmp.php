<?php
/**
 * Main initialization class.
 *
 * @package Radius_Amp
 */

require_once __DIR__ . './../vendor/autoload.php';

use RT\Amp\Traits\Singleton;
use RT\Amp\Helpers\Fns;
use RT\Amp\Controllers\
{
	FrontendController,
	CustomizerController
};

if ( ! class_exists( RttlpAmp::class ) ) {
	/**
	 * Main initialization class.
	 */
	final class RttlpAmp {

		use Singleton;

		/**
		 * Theme.
		 *
		 * @var string
		 */
		public $theme;

		/**
		 * Theme prefix.
		 *
		 * @var string
		 */
		public $theme_prfx;

		/**
		 * Plugin path.
		 *
		 * @var string
		 */
		public $plugin_path;

		/**
		 * Class init.
		 *
		 * @return void
		 */
		public function init( $theme, $theme_prefix ) {
			$this->theme = $theme;
			$this->theme_prefix = $theme_prefix;

			// Hooks.
			$this->init_hooks();
		}

		/**
		 * Init Hooks.
		 *
		 * @return void
		 */
		private function init_hooks() {
			\add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ), -1 );
			\add_action( 'init', array( $this, 'init_services' ) );
			\add_filter( 'amp_post_status_default_enabled', '__return_true' );
		}

		/**
		 * Init services.
		 *
		 * @return void
		 */
		public function init_services() {
			$this->i18n();
			$this->init_controllers();
		}

		/**
		 * Internationalization.
		 *
		 * @return void
		 */
		public function i18n() {
			load_plugin_textdomain( 'radius-amp', false, RT_AMP_LANGUAGE_PATH );
		}

		/**
		 * Init Controllers.
		 *
		 * @return void
		 */
		public function init_controllers() {
			Fns::instances( $this->controllers() );
		}

		/**
		 * Controllers.
		 *
		 * @return array
		 */
		public function controllers() {
			$controllers = array(
				FrontendController::class,
				CustomizerController::class,
			);

			return $controllers;
		}

		/**
		 * Actions on Plugins Loaded.
		 *
		 * @return void
		 */
		public function on_plugins_loaded() {
			\do_action( 'rtamp_loaded' );
		}

		/**
		 * Plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( RT_AMP_PLUGIN_ACTIVE_FILE_NAME ) );
		}

		/**
		 * Template path
		 *
		 * @return string
		 */
		public function templates_path() {
			return apply_filters( 'rttlp_amp_template_path', $this->plugin_path() . '/templates/' );
		}

		/**
		 * Assets URL.
		 *
		 * @return string
		 */
		public function assets_url() {
			return esc_url( RT_AMP_PLUGIN_URL . '/assets/' );
		}

		/**
		 * RT Theme name.
		 *
		 * @return string
		 */
		public function theme_class() {
			return $this->theme;
		}

		/**
		 * RT Theme prefix.
		 *
		 * @return string
		 */
		public function theme_prefix() {
			return $this->theme_prefix;
		}
	}
}
