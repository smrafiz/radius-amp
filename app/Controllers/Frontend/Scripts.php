<?php
/**
 * Scripts Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers\Frontend;

use RT\Amp\Helpers\Fns;
use RT\Amp\Traits\Singleton;

/**
 * Scripts Class.
 */
class Scripts {
	use Singleton;

	public function init() {
		if ( ! Fns::is_amp_active() ) {
			return;
		}

		\add_action( 'rt_amp_post_template_head', array( $this, 'enqueue' ) );
	}

	public function enqueue() {
		echo '<link href="' . rttlp_amp()->assets_url() . 'css/bootstrap.min.css" rel="stylesheet" type="text/css">';
		echo '<link href="' . rttlp_amp()->assets_url() . 'css/default.css" rel="stylesheet" type="text/css">';
		echo '<link href="' . rttlp_amp()->assets_url() . 'css/amp-common.css" rel="stylesheet" type="text/css">';
		echo '<link href="' . rttlp_amp()->assets_url() . 'css/amp-single.css" rel="stylesheet" type="text/css">';
	}
}
