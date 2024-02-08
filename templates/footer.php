<?php
/**
 * Template: Footer.
 *
 * @package Radius_AMP
 */

$logo    = '';
$theme   = rttlp_amp()->theme_class();
$helper  = $theme . '_helper'::class;
$socials = $helper::socials();

if ( ! empty( get_theme_mod( 'rttlp_amp_footer_logo', false ) ) ) {
	$logo = wp_get_attachment_image( get_theme_mod( 'rttlp_amp_footer_logo', false ), 'full' );
}
?>

<footer class="amp-wp-footer">
	<div class="container">
		<div class="amp-wp-footer-inner">
			<div class="wp-amp-footer-content">
				<?php
				if ( ! empty( $logo ) ) {
					?>
					<div class="wp-amp-footer-logo">
						<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo wp_kses( $logo, 'allow_link' ); ?></a>
					</div>
					<?php
				}
				?>
				<div class="wp-amp-footer-content">
					<?php echo wp_kses( get_theme_mod( 'rttlp_amp_footer_top_text', __( 'The Most Powerful News, Blog & Magazine WordPress Theme', 'radius-amp' ) ), 'alltext_allow' ); ?>
				</div>
			</div>

			<?php
			if ( get_theme_mod( 'rttlp_amp_footer_socials', 1 ) && $socials ) {
				?>
				<div class="wp-amp-footer-socials">
					<ul class="list-inline">
						<li class="list-inline-item"><?php esc_html_e( 'Follow Us On:', 'radius-amp' ); ?></li>
						<?php
						if ( ! empty( $socials ) ) {
							foreach ( $socials as $social ) {
								echo '<li class="list-inline-item socials"><a href="' . esc_url( $social['url'] ) . '"><i class="fab ' . esc_attr( $social['icon'] ) . '"></i></a></li>';
							}
						}
						?>
					</ul>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		if ( $theme::$options['copyright_area'] ) {
			?>
			<div class="amp-wp-copyright">
				<?php echo wp_kses( $theme::$options['copyright_text'], 'allow_link' ); ?>
			</div>
			<?php
		}
		?>
		<div class="to-top">
			<a href="#top" class="scroll-wrap">
				<svg
					class="scroll-circle svg-content"
					width="100%"
					height="100%"
					viewBox="-1 -1 102 102"
				>
					<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
				</svg>
			</a>
		</div>
	</div>
</footer>
