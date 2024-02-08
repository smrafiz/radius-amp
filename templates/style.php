<?php
/**
 * Style template.
 *
 * @package Radius_Amp
 */

$theme             = rttlp_amp()->theme_class();
$primary_color     = get_theme_mod( 'rttlp_amp_primary_color', '#2962ff' );
$text_color        = get_theme_mod( 'rttlp_amp_text_color', '#6c6f72' );
$breadcrumb_bg     = get_theme_mod( 'single_post_bgcolor', '#f7f7f7' );
$breadcrumb_link   = get_theme_mod( 'breadcrumb_link_color', '#646464' );
$breadcrumb_active = get_theme_mod( 'breadcrumb_active_color', '#2962ff' );
$breadcrumb_sep    = get_theme_mod( 'breadcrumb_seperator_color', '#646464' );
$footer_bg_color   = get_theme_mod( 'fbgcolor', '#f7f7f7' );
$footer_text_color = get_theme_mod( 'footer_color', '#6c6f72' );
$footer_link_color = get_theme_mod( 'footer_link_color', '#333' );
$footer_social     = get_theme_mod( 'rttlp_amp_footer_socials_color', '#646464' );
$logo_width        = get_theme_mod( 'logo_width', '110' );

/*
 = Body Typo Area
=======================================================*/
$typo_body = json_decode( $theme::$options['typo_body'], true );
if ( $typo_body['font'] == 'Inherit' ) {
	$typo_body['font'] = 'Roboto';
} else {
	$typo_body['font'] = $typo_body['font'];
}

/*
 = Menu Typo Area
=======================================================*/
$typo_menu = json_decode( $theme::$options['typo_menu'], true );
if ( $typo_menu['font'] == 'Inherit' ) {
	$typo_menu['font'] = 'Spartan';
} else {
	$typo_menu['font'] = $typo_menu['font'];
}

$typo_sub_menu = json_decode( $theme::$options['typo_sub_menu'], true );
if ( $typo_sub_menu['font'] == 'Inherit' ) {
	$typo_sub_menu['font'] = 'Spartan';
} else {
	$typo_sub_menu['font'] = $typo_sub_menu['font'];
}

/*
 = Heading Typo Area
=======================================================*/
$typo_heading = json_decode( $theme::$options['typo_heading'], true );
if ( $typo_heading['font'] == 'Inherit' ) {
	$typo_heading['font'] = 'Spartan';
} else {
	$typo_heading['font'] = $typo_heading['font'];
}
$typo_h1 = json_decode( $theme::$options['typo_h1'], true );
if ( $typo_h1['font'] == 'Inherit' ) {
	$typo_h1['font'] = 'Spartan';
} else {
	$typo_h1['font'] = $typo_h1['font'];
}
$typo_h2 = json_decode( $theme::$options['typo_h2'], true );
if ( $typo_h2['font'] == 'Inherit' ) {
	$typo_h2['font'] = 'Spartan';
} else {
	$typo_h2['font'] = $typo_h2['font'];
}
$typo_h3 = json_decode( $theme::$options['typo_h3'], true );
if ( $typo_h3['font'] == 'Inherit' ) {
	$typo_h3['font'] = 'Spartan';
} else {
	$typo_h3['font'] = $typo_h3['font'];
}
$typo_h4 = json_decode( $theme::$options['typo_h4'], true );
if ( $typo_h4['font'] == 'Inherit' ) {
	$typo_h4['font'] = 'Spartan';
} else {
	$typo_h4['font'] = $typo_h4['font'];
}
$typo_h5 = json_decode( $theme::$options['typo_h5'], true );
if ( $typo_h5['font'] == 'Inherit' ) {
	$typo_h5['font'] = 'Spartan';
} else {
	$typo_h5['font'] = $typo_h5['font'];
}
$typo_h6 = json_decode( $theme::$options['typo_h6'], true );
if ( $typo_h6['font'] == 'Inherit' ) {
	$typo_h6['font'] = 'Spartan';
} else {
	$typo_h6['font'] = $typo_h6['font'];
}
?>

body {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: '<?php echo esc_html( $typo_body['font'] ); ?>', sans-serif !important;
	font-size: <?php echo esc_html( $theme::$options['typo_body_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_body_height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_body['regularweight'] ); ?>;
}
h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6 {
	font-family: '<?php echo esc_html( $typo_heading['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_heading['regularweight'] ); ?>;
}
<?php if ( ! empty( $typo_h1['font'] ) ) { ?>
h1,.h1 {
	font-family: '<?php echo esc_html( $typo_h1['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_h1['regularweight'] ); ?>;
}
<?php } ?>
h1,.h1 {
	font-size: <?php echo esc_html( $theme::$options['typo_h1_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_h1_height'] ); ?>;
	font-style: normal;
}
<?php if ( ! empty( $typo_h2['font'] ) ) { ?>
h2,.h2 {
	font-family: '<?php echo esc_html( $typo_h2['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_h2['regularweight'] ); ?>;
}
<?php } ?>
h2,.h2 {
	font-size: <?php echo esc_html( $theme::$options['typo_h2_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_h2_height'] ); ?>;
	font-style: normal;
}
<?php if ( ! empty( $typo_h3['font'] ) ) { ?>
h3,.h3 {
	font-family: '<?php echo esc_html( $typo_h3['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_h3['regularweight'] ); ?>;
}
<?php } ?>
h3,.h3 {
	font-size: <?php echo esc_html( $theme::$options['typo_h3_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_h3_height'] ); ?>;
	font-style: normal;
}
<?php if ( ! empty( $typo_h4['font'] ) ) { ?>
h4,.h4 {
	font-family: '<?php echo esc_html( $typo_h4['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_h4['regularweight'] ); ?>;
}
<?php } ?>
h4,.h4 {
	font-size: <?php echo esc_html( $theme::$options['typo_h4_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_h4_height'] ); ?>;
	font-style: normal;
}
<?php if ( ! empty( $typo_h5['font'] ) ) { ?>
h5,.h5 {
	font-family: '<?php echo esc_html( $typo_h5['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_h5['regularweight'] ); ?>;
}
<?php } ?>
h5,.h5 {
	font-size: <?php echo esc_html( $theme::$options['typo_h5_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_h5_height'] ); ?>;
	font-style: normal;
}
<?php if ( ! empty( $typo_h6['font'] ) ) { ?>
h6,.h6 {
	font-family: '<?php echo esc_html( $typo_h6['font'] ); ?>', sans-serif;
	font-weight : <?php echo esc_html( $typo_h6['regularweight'] ); ?>;
}
<?php } ?>
h6,.h6 {
	font-size: <?php echo esc_html( $theme::$options['typo_h6_size'] ); ?>;
	line-height: <?php echo esc_html( $theme::$options['typo_h6_height'] ); ?>;
	font-style: normal;
}
.rt-slide-nav .offscreen-navigation li > a,
.rt-slide-nav .offscreen-navigation .sub-menu li > a,
.site-header .main-navigation nav ul li a {
	font-family: '<?php echo esc_html( $typo_heading['font'] ); ?>', sans-serif;
	line-height: <?php echo esc_html( $theme::$options['typo_menu_height'] ); ?>;
	font-weight : <?php echo esc_html( $typo_menu['regularweight'] ); ?>;
	font-style: normal;
}
.rt-slide-nav .offscreen-navigation li > a,
.site-header .main-navigation nav ul li a {
	font-size: <?php echo esc_html( $theme::$options['typo_menu_size'] ); ?>;
}
.scroll-wrap svg.scroll-circle path {
	stroke: <?php echo sanitize_hex_color( $primary_color ); ?>;
}
blockquote.wp-block-quote cite,
.wp-block-quote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
}
.scroll-wrap:after,
.rt-slide-nav .offscreen-navigation li.current-menu-item > a,
.rt-slide-nav .offscreen-navigation li.current-menu-parent > a,
.header-search .header-search-form .search-btn:hover,
.header-search .stylish-input-group .btn:hover,
.header-search .custom-search-input .btn:hover,
.amp-wp-breadcrumb .entry-breadcrumb span a:hover,
.amp-wp-breadcrumb .entry-breadcrumb .current-item,
.amp-wp-breadcrumb .entry-breadcrumb span.current,
.breadcrumb-trail ul.trail-items li,
.breadcrumb-trail ul.trail-items li a,
.site-main .entry-breadcrumb .current,
.entry-header ul.entry-meta li a:hover,
.amp-wp-footer a:hover,
.wp-amp-footer-socials .socials a:hover,
.post-navigation a:hover,
.post-navigation .prev-article:hover,
.amp-related-posts .entry-content .entry-categories a:hover,
.amp-wp-breadcrumb .entry-breadcrumb .current-item {
	color: <?php echo sanitize_hex_color( $primary_color ); ?>;
}
.header-search .header-search-form input[type=search] {
	border-bottom: 1px solid <?php echo sanitize_hex_color( $primary_color ); ?>;
}
#respond .btn-send,
#respond .btn-send:hover,
#respond .btn-send:focus,
.page-links span.current .page-number,
.page-links a.post-page-numbers:hover .page-number,
body[data-color-mode="dark"] a.scroll-wrap,
.entry-categories .category-style {
	background-color: <?php echo sanitize_hex_color( $primary_color ); ?>;
}
.amp-related-posts .carousel-prev:hover,
.amp-related-posts .carousel-next:hover,
.has-neeon-primary-background-color.is-style-solid-color blockquote,
.meta-tags a:hover {
	background: <?php echo sanitize_hex_color( $primary_color ); ?>;
}
.wp-block-pullquote {
	border-top: 2px solid <?php echo sanitize_hex_color( $primary_color ); ?>;
	border-bottom: 2px solid <?php echo sanitize_hex_color( $primary_color ); ?>;
}
.entry-banner {
	background: <?php echo sanitize_hex_color( $breadcrumb_bg ); ?>;
}
.amp-wp-breadcrumb .entry-breadcrumb span a {
	color: <?php echo sanitize_hex_color( $breadcrumb_link ); ?>;
}
.amp-wp-breadcrumb .entry-breadcrumb .current-item {
	color: <?php echo sanitize_hex_color( $breadcrumb_active ); ?>;
}
.amp-wp-breadcrumb .entry-breadcrumb > span:first-child > i,
.entry-banner .entry-breadcrumb .dvdr {
	color: <?php echo sanitize_hex_color( $breadcrumb_sep ); ?>;
}
.amp-wp-footer {
	background-color: <?php echo sanitize_hex_color( $footer_bg_color ); ?>;
	color: <?php echo sanitize_hex_color( $footer_text_color ); ?>;
}
.amp-wp-footer a {
	color: <?php echo sanitize_hex_color( $footer_link_color ); ?>;
}
.wp-amp-footer-socials .socials a {
	color: <?php echo sanitize_hex_color( $footer_social ); ?>;
}
body[data-color-mode="dark"] .scroll-wrap:after {
	color: #fff
}
if ( ! empty( $logo_width  ) ) {
	.mean-container .mean-bar amp-img {
		max-width: <?php echo esc_attr( $logo_width ); ?>px;
	}
}
