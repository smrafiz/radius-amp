<?php
/**
 * Template: Post Navigation.
 *
 * @package Radius_AMP
 */

use RT\Amp\Helpers\Fns;
?>

<div class="post-nav">
	<div class="container">
		<?php
		$nav_fn = rttlp_amp()->theme_prefix() . '_post_links_next_prev';
		$nav_fn();
		?>
	</div>
</div>
