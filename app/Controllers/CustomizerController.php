<?php
/**
 * Admin Controller Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers;

use RT\Amp\Traits\Singleton;
use RT\Amp\Abstracts\Controller;
use RT\Amp\Controllers\Customizer\Init;

/**
 * Admin Controller Class.
 */
class CustomizerController extends Controller {
	use Singleton;

	protected function classes() {
		return array(
			Init::class,
		);
	}
}
