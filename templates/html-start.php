<?php
/**
 * Template: HTML Start.
 *
 * @package Radius_AMP
 */

use RT\Amp\Helpers\Fns;
?>

<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">

	<?php
	do_action( 'amp_post_template_head', $this );
	do_action( 'rt_amp_post_template_head' );
	?>

	<style class="style-template-part">
		<?php
		$this->load_parts( array( 'style' ) );
		do_action( 'rt_amp_post_template_css' );
		?>
	</style>
</head>
<body class="<?php echo esc_attr( 'radius-amp' ); ?>" data-color-mode="<?php echo esc_attr( get_theme_mod( 'rttlp_amp_color_scheme', 'light' ) ); ?>">
	<?php
	wp_body_open();
	do_action( 'amp_post_template_body_open', $this );
	?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'radius-amp' ); ?></a>

		<?php
		do_action( 'rt_amp_before_header', $this );

		/**
		 * Header.
		 */
		if ( get_theme_mod( 'rttlp_enable_amp_header', 1 ) ) {
			$this->load_parts( array( 'header' ) );
		}

		?>
		<div id="content" class="site-content">
			<?php
			/**
			 * Breadcrumbs.
			 */
			if ( rttlp_amp()->theme_class()::$options['single_post_breadcrumb'] ) {
				$this->load_parts( array( 'breadcrumbs' ) );
			}

			do_action( 'rt_amp_after_header', $this );
			?>
