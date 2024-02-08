<?php
/**
 * Templates Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers\Frontend;

use RT\Amp\Helpers\Fns;
use RT\Amp\Traits\Singleton;

/**
 * Templates Class.
 */
class Fonts {
	use Singleton;

	public function init() {
		\add_filter( 'amp_post_template_data', array( $this, 'google_font' ) );
		\add_action( 'rt_amp_post_template_head', array( $this, 'icons' ) );
	}

	public function google_font( $amp_data ) {
		if ( ! class_exists( rttlp_amp()->theme_class() ) ) {
			return;
		}

		$heading = array(
			'font'          => 'Spartan',
			'regularweight' => '500',
		);
		$body    = array(
			'font'          => 'Roboto',
			'regularweight' => '400',
		);

		$heading = json_decode( \rttlp_amp()->theme_class()::$options['typo_heading'], true );
		$body    = json_decode( \rttlp_amp()->theme_class()::$options['typo_body'], true );

		if ( $body['font'] == 'Inherit' ) {
			$bodyFont = 'Roboto';
		} else {
			$bodyFont = $body['font'];
		}

		if ( $heading['font'] == 'Inherit' ) {
			$hFont = 'Spartan';
		} else {
			$hFont = $heading['font'];
		}

		$bodyFontW = $body['regularweight'];
		$hFontW    = $heading['regularweight'];

		if ( ! empty( $heading ) ) {
			$font_families[] = $hFont . ':' . $hFontW;
		}

		if ( ! empty( $body ) ) {
			$font_families[] = $bodyFont . ':' . $bodyFontW;
		}

		$final_fonts = array_unique( $font_families );
		$query_args  = array(
			'family'  => urlencode( implode( '|', $final_fonts ) ),
			'display' => urlencode( 'swap' ),
		);

		$fonts_url = esc_url_raw( add_query_arg( $query_args, '//fonts.googleapis.com/css' ) );

		if ( empty( $fonts_url ) ) {
			return $amp_data;
		}

		$fonts_url = 'https:' . $fonts_url;

		$amp_data['font_urls'] = array(
			'customizer-fonts' => esc_url( $fonts_url ),
		);

		return $amp_data;
	}

	public function icons() {
		echo '<link href="' . rttlp_amp()->assets_url() . 'css/font-awesome.min.css" id="fontawesome-css" rel="stylesheet" type="text/css">';
		echo '<link href="' . rttlp_amp()->assets_url() . 'css/flaticon.css" id="flaticon-css" rel="stylesheet" type="text/css">';
	}
}
