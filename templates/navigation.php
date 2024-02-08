<?php
/**
 * Template: Navigation.
 *
 * @package Radius_AMP
 */

use RT\Amp\Helpers\Fns;
?>

<div class="mobile-mene-bar">
	<div class="mean-bar" <?php echo Fns::amp_class( 'mean-bar', 'expanded', 'mobileMenuActive' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<span class="sidebarBtn" <?php echo Fns::amp_toggle( 'mobileMenuActive' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</span>
		<?php
		/**
		 * Logo.
		 */
		$this->load_parts( array( 'site-branding' ) );

		if ( get_theme_mod( 'rttlp_enable_amp_search', 1 ) ) {
			?>
			<div class="search-icon">
				<a href="#header-search" title="<?php esc_attr_e( 'Search', 'radius-amp' ); ?>" <?php echo Fns::amp_toggle( 'headerSearchActive' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<i class="fas fa-search"></i>
				</a>
			</div>
			<?php
		}
		?>
	</div>
	<div class="rt-slide-nav">
		<div class="offscreen-navigation">
			<?php wp_nav_menu( Fns::nav_menu_args() ); ?>
		</div>
	</div>
</div>
