<?php
/**
 * Frontend Controller Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers;

use RT\Amp\Abstracts\Controller;
use RT\Amp\Traits\Singleton;
use RT\Amp\Helpers\Fns;
use RT\Amp\Controllers\Frontend\
{
	Fonts,
	Hooks,
	Scripts,
	Templates
};

/**
 * Frontend Controller Class.
 */
class FrontendController extends Controller {
	use Singleton;

	public function init() {
		add_action( 'wp', array( $this, 'check_amp' ) );
	}

	public function check_amp() {
		if ( ! Fns::is_amp_active() ) {
			return array();
		}

		parent::init();
	}

	protected function classes() {
		if ( is_admin() ) {
			return array();
		}

		return array(
			Fonts::class,
			Hooks::class,
			Scripts::class,
			Templates::class,
		);
	}
}
