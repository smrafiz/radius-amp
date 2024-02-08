<?php
/**
 * Singleton Trait.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Traits;

/**
 * Singleton Trait.
 */
trait Singleton {

	/**
	 * Store the singleton object.
	 *
	 * @var boolean
	 */
	private static $singleton = false;

	/**
	 * Create an inaccessible constructor.
	 */
	private function __construct() {
	}

	/**
	 * Prevent cloning.
	 */
	private function __clone() {
	}

	/**
	 * Prevent unserializing.
	 */
	public function __wakeup() {
	}

	/**
	 * Fetch an instance of the class.
	 */
	public static function get_instance() {
		if ( false === self::$singleton ) {
			self::$singleton = new self();
		}

		return self::$singleton;
	}
}
