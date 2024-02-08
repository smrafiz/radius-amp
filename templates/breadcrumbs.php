<?php
/**
 * Template: Breadcrumbs.
 *
 * @package Radius_AMP
 */

$prefix         = rttlp_amp()->theme_prefix();
$breadcrumbs_fn = $prefix . '_breadcrumbs';
?>

<div class="entry-banner">
	<div class="container">
		<div class="entry-banner-content">
			<div class="amp-wp-breadcrumb">
				<div class="entry-breadcrumb">
					<?php
					if ( function_exists( 'bcn_display' ) ) {
						if ( is_rtl() ) {
							bcn_display( false, true, true );
						} else {
							bcn_display();
						}
					} else {
						$breadcrumbs_fn();
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
