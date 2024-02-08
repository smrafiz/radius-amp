<?php
/**
 * Abstract Class for Controller.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Abstracts;

use RT\Amp\Helpers\Fns;

/**
 * Abstract Class for Controller.
 */
abstract class Controller {
	/**
	 * Classes to include.
	 *
	 * @return array
	 */
	abstract protected function classes();

	/**
	 * Initializes the class.
	 *
	 * @return void
	 */
	public function init() {
		if ( empty( $this->classes() ) ) {
			return;
		}

		Fns::instances( $this->classes() );
	}
}
