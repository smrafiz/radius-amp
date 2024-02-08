<?php
/**
 * Customizer settings Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers\Customizer;

use RT\Amp\Traits\Singleton;
use radiustheme\neeon\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\neeon\Customizer\Controls\Customizer_Heading_Control;

/**
 * Customizer settings Class.
 */
class Settings {
	use Singleton;

	private static $settings = array();

	public function init() {
		self::controls();

		return self::$settings;
	}

	private static function controls() {
		self::$settings[] = array(
			'id'                => 'rttlp_amp_footer_heading',
			'control_class'     => Customizer_Heading_Control::class,
			'sanitize_callback' => 'esc_html',
			'args'              => array(
				'label'   => __( 'AMP Footer Settings', 'radius-amp' ),
				'section' => 'footer_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_footer_logo',
			'control_class'     => \WP_Customize_Media_Control::class,
			'sanitize_callback' => 'absint',
			'args'              => array(
				'label'         => __( 'Upload AMP Footer logo?', 'radius-amp' ),
				'description'   => __( 'Please upload AMP Footer logo. Logo will be disabled if the field is kept empty.', 'radius-amp' ),
				'section'       => 'footer_section',
				'mime_type'     => 'image',
				'button_labels' => array(
					'select'       => __( 'Select File', 'radius-amp' ),
					'change'       => __( 'Change File', 'radius-amp' ),
					'default'      => __( 'Default', 'radius-amp' ),
					'remove'       => __( 'Remove', 'radius-amp' ),
					'placeholder'  => __( 'No file selected', 'radius-amp' ),
					'frame_title'  => __( 'Select File', 'radius-amp' ),
					'frame_button' => __( 'Choose File', 'radius-amp' ),
				),
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_footer_top_text',
			'control_class'     => \WP_Customize_Control::class,
			'default'           => __( 'The Most Powerful News, Blog & Magazine WordPress Theme', 'radius-amp' ),
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_textarea_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Footer top text.', 'radius-amp' ),
				'description' => __( 'Please enter AMP Footer top text.', 'radius-amp' ),
				'section'     => 'footer_section',
				'type'        => 'textarea',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_footer_socials',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 1,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'Enable AMP Footer social media?', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP Footer social media icons. Note: to show social media icons, you have to enter social URL from General Settings.', 'radius-amp' ),
				'section'     => 'footer_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_footer_socials_color',
			'control_class'     => \WP_Customize_Color_Control::class,
			'default'           => '#646464',
			'sanitize_callback' => 'sanitize_hex_color',
			'args'              => array(
				'label'       => __( 'AMP Social Media color', 'radius-amp' ),
				'description' => __( 'Please choose the social media color.', 'radius-amp' ),
				'section'     => 'footer_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_primary_color',
			'control_class'     => \WP_Customize_Color_Control::class,
			'default'           => '#2962ff',
			'sanitize_callback' => 'sanitize_hex_color',
			'args'              => array(
				'label'       => __( 'AMP Primary Color', 'radius-amp' ),
				'description' => __( 'Please choose the primary color.', 'radius-amp' ),
				'section'     => 'amp_design',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_text_color',
			'control_class'     => \WP_Customize_Color_Control::class,
			'default'           => '#6c6f72',
			'sanitize_callback' => 'sanitize_hex_color',
			'args'              => array(
				'label'       => __( 'AMP Body Text Color', 'radius-amp' ),
				'description' => __( 'Please choose the body text color.', 'radius-amp' ),
				'section'     => 'amp_design',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_color_scheme',
			'control_class'     => \WP_Customize_Control::class,
			'default'           => 'light',
			'sanitize_callback' => 'rttheme_radio_sanitization',
			'args'              => array(
				'label'       => __( 'Color Scheme.', 'radius-amp' ),
				'description' => __( 'Please select the color scheme.', 'radius-amp' ),
				'section'     => 'amp_design',
				'type'        => 'select',
				'choices'     => array(
					'light' => esc_html__( 'Light', 'radius-amp' ),
					'dark'  => esc_html__( 'Dark', 'radius-amp' ),
				),
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_header',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 1,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Header On/Off', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP header.', 'radius-amp' ),
				'section'     => 'rttlp_amp_header_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_sticky_header',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 1,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Sticky Header', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP sticky header.', 'radius-amp' ),
				'section'     => 'rttlp_amp_header_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_search',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 1,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Header Search', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP header search.', 'radius-amp' ),
				'section'     => 'rttlp_amp_header_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_amp_ad_heading',
			'control_class'     => Customizer_Heading_Control::class,
			'sanitize_callback' => 'esc_html',
			'args'              => array(
				'label'   => __( 'AMP Ad Settings', 'radius-amp' ),
				'section' => 'ad_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_ad_before_header',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 0,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Ad Before Header', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP ad before header.', 'radius-amp' ),
				'section'     => 'ad_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_ad_after_header',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 0,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Ad After Header', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP ad after header.', 'radius-amp' ),
				'section'     => 'ad_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_ad_before_pc',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 0,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Ad Before Post Content', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP ad before post content.', 'radius-amp' ),
				'section'     => 'ad_section',
			),
		);

		self::$settings[] = array(
			'id'                => 'rttlp_enable_amp_ad_after_pc',
			'control_class'     => Customizer_Switch_Control::class,
			'default'           => 0,
			'sanitize_callback' => 'rttheme_switch_sanitization',
			'args'              => array(
				'label'       => __( 'AMP Ad After Post Content', 'radius-amp' ),
				'description' => __( 'Enable/disable AMP ad after post content.', 'radius-amp' ),
				'section'     => 'ad_section',
			),
		);

		return new static();
	}
}
