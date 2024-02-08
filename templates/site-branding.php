<?php
/**
 * Template: Site branding.
 *
 * @package Radius_AMP
 */

$theme = rttlp_amp()->theme_class();
$logo  = '';

if ( ! empty( $theme::$options['logo'] ) ) {
	$logo = wp_get_attachment_image( $theme::$options['logo'], 'full' );
}
?>

<div class="site-branding">
	<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo wp_kses( $logo, 'allow_link' ); ?></a>
</div>
