<?php
/**
 * Single view template.
 *
 * @package Radius_AMP
 */

/**
 * Template start.
 */
$this->load_parts( array( 'html-start' ) );
?>
	<div id="primary" class="content-area">
		<?php
		/**
		 * Article.
		 */
		$this->load_parts( array( 'article' ) );

		/**
		 * Post Navigation.
		 */
		if ( rttlp_amp()->theme_class()::$options['post_links'] ) {
			$this->load_parts( array( 'post-nav' ) );
		}

		/**
		 * Comments.
		 */
		$this->load_parts( array( 'comments' ) );

		/**
		 * Related Posts.
		 */
		if ( rttlp_amp()->theme_class()::$options['show_related_post'] == '1' && is_single() ) {
			$this->load_parts( array( 'related' ) );
		}
		?>
	</div>
<?php
/**
 * Template end.
 */
$this->load_parts( array( 'html-end' ) );
?>
