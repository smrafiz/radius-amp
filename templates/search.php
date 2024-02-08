<?php
/**
 * Template: Search.
 *
 * @package Radius_AMP
 */

use RT\Amp\Helpers\Fns;
?>

<div id="header-search" class="header-search" <?php echo Fns::amp_class( 'header-search', 'open', 'headerSearchActive' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<button type="button" class="close" <?php echo Fns::amp_toggle( 'headerSearchActive' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>×</button>
	<form class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e( 'Type your search........', 'radius-amp' ); ?>">
		<button type="submit" class="search-btn">
			<i class="fas fa-search"></i>
		</button>
	</form>
</div>
