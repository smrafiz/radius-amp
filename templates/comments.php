<?php
/**
 * Template: Comments.
 *
 * @package Radius_AMP
 */

if ( ! function_exists( 'rtrs' ) ) {
	if ( comments_open() || get_comments_number() ) {
		echo '<div class="container">';
			comments_template();
		echo '</div>';
	}
} else {
	$comments_link_url = $this->get( 'comments_link_url' );

	if ( $comments_link_url ) {
		$comments_link_text = $this->get( 'comments_link_text' );
		?>
		<div class="container">
			<div id="respond" class="amp-wp-meta amp-wp-comments-link text-center">
				<a class="submit btn-send" href="<?php echo esc_url( $comments_link_url ); ?>">
					<?php echo esc_html( $comments_link_text ); ?>
				</a>
			</div>
		</div>
		<?php
	}
}
