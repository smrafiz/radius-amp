<?php
/**
 * Hooks Class.
 *
 * @package Radius_Amp
 */

namespace RT\Amp\Controllers\Frontend;

use RT\Amp\Helpers\Fns;
use RT\Amp\Traits\Singleton;

/**
 * Hooks Class.
 */
class Hooks {
	use Singleton;

	private $theme;

	public function init() {
		if ( ! Fns::is_amp_active() ) {
			return;
		}

		$this->theme = rttlp_amp()->theme_class();

		\add_action( 'rt_amp_before_header', array( $this, 'before_header' ) );
		\add_action( 'rt_amp_after_header', array( $this, 'after_header' ) );
		\add_action( 'rt_amp_before_post_content', array( $this, 'before_post_content' ) );
		\add_action( 'rt_amp_after_post_content', array( $this, 'after_post_content' ) );
	}

	public function before_header() {
		if ( ! get_theme_mod( 'rttlp_enable_amp_ad_before_header', 0 ) ) {
			return;
		}

		$this->render_ad( 'before_header' );
	}

	public function after_header() {
		if ( ! get_theme_mod( 'rttlp_enable_amp_ad_after_header', 0 ) ) {
			return;
		}

		$this->render_ad( 'after_header' );
	}

	public function before_post_content() {
		if ( ! get_theme_mod( 'rttlp_enable_amp_ad_before_pc', 0 ) ) {
			return;
		}

		$this->render_ad( 'before_post_content' );
	}

	public function after_post_content() {
		if ( ! get_theme_mod( 'rttlp_enable_amp_ad_after_pc', 0 ) ) {
			return;
		}

		$this->render_ad( 'after_post_content' );
	}

	public function render_ad( $location ) {
		$type   = '';
		$link   = '';
		$target = '';
		$image  = '';
		$code   = '';
		$ad     = '';

		if ( 'before_header' === $location ) {
			$type     = $this->theme::$options['before_ad_type'];
			$link     = $this->theme::$options['before_ad_img_link'];
			$target   = $this->theme::$options['before_ad_img_target'] ? 'target="_blank"' : '';
			$image_id = $this->theme::$options['before_adimage'];
			$image    = wp_get_attachment_image( $image_id, 'full' );
			$code     = $this->theme::$options['before_adcustom'];
		}

		if ( 'after_header' === $location ) {
			$type     = $this->theme::$options['ad_type'];
			$link     = $this->theme::$options['ad_img_link'];
			$target   = $this->theme::$options['ad_img_target'] ? 'target="_blank"' : '';
			$image_id = $this->theme::$options['adimage'];
			$image    = wp_get_attachment_image( $image_id, 'full' );
			$code     = $this->theme::$options['adcustom'];
		}

		if ( 'before_post_content' === $location ) {
			$type     = $this->theme::$options['ad_before_post_type'];
			$link     = $this->theme::$options['post_before_ad_img_link'];
			$target   = $this->theme::$options['post_before_ad_img_target'] ? 'target="_blank"' : '';
			$image_id = $this->theme::$options['post_before_adimage'];
			$image    = wp_get_attachment_image( $image_id, 'full' );
			$code     = $this->theme::$options['post_before_adcustom'];
		}

		if ( 'after_post_content' === $location ) {
			$type     = $this->theme::$options['ad_after_post_type'];
			$link     = $this->theme::$options['post_after_ad_img_link'];
			$target   = $this->theme::$options['post_after_ad_img_target'] ? 'target="_blank"' : '';
			$image_id = $this->theme::$options['post_after_adimage'];
			$image    = wp_get_attachment_image( $image_id, 'full' );
			$code     = $this->theme::$options['post_after_adcustom'];
		}

		if ( 'before_adimage' === $type || 'adimage' === $type || 'post_before_adimage' === $type || 'post_after_adimage' === $type ) {
			if ( $link ) {
				$ad .= '<a ' . $target . ' href="' . esc_url( $link ) . '">' . wp_kses( $image, 'allow_link' ) . '</a>';
			} else {
				$ad .= wp_kses( $image, 'allow_link' );
			}
		} elseif ( 'before_adcustom' === $type || 'adcustom' === $type || 'post_before_adcustom' === $type || 'post_after_adcustom' === $type ) {
			$ad .= $code;
		}

		?>
		<div class="wp-amp-ad d-flex justify-content-center ad_<?php echo esc_attr( $location ); ?>">
			<?php echo $ad; ?>
		</div>
		<?php
	}
}
