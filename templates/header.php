<?php
/**
 * Template: Header.
 *
 * @package Radius_AMP
 */

use RT\Amp\Helpers\Fns;


$is_sticky    = get_theme_mod( 'rttlp_enable_amp_sticky_header', 1 );
$sticky_class = $is_sticky ? 'header-sticky' : '';

if ( is_admin_bar_showing() ) {
	$sticky_class .= ' admin-bar-active';
}
?>

<header id="#top" class="wp-amp-header <?php echo esc_attr( $sticky_class ); ?>">
	<div class="header-area">
		<div class="container">
			<div class="row">
				<div class="header-wrapper">
					<div class="rt-header-menu mean-container" id="meanmenu">
						<?php
						/**
						 * Nav.
						 */
						$this->load_parts( array( 'navigation' ) );
						?>
					</div>
				</div>
			</div>
			<?php
			/**
			 * Search.
			 */
			if ( get_theme_mod( 'rttlp_enable_amp_search', 1 ) ) {
				$this->load_parts( array( 'search' ) );
			}
			?>
		</div>
	</div>
</header>
