<?php
/**
 * Template: Article.
 *
 * @package Radius_AMP
 */

$post_author     = $this->get( 'post_author' );
$author_bio      = get_the_author_meta( 'description' );
$theme           = rttlp_amp()->theme_class();
$theme_prefix    = rttlp_amp()->theme_prefix();
$category_fn     = $theme_prefix . '_single_category_prepare';
$reading_time_fn = $theme_prefix . '_reading_time';
$post_views_fn   = $theme_prefix . '_views';
$human_time_fn   = $theme_prefix . '_get_time';
$post_share_fn   = $theme_prefix . '_post_share';
$youtube_link    = get_post_meta( get_the_ID(), $theme_prefix . '_youtube_link', true );

$comments_number = number_format_i18n( get_comments_number() );
$comments_html   = $comments_number == 1 ? esc_html__( 'Comment', 'radius-amp' ) : esc_html__( 'Comments', 'radius-amp' );
$comments_html   = '<span class="comment-number">' . $comments_number . '</span> ' . $comments_html;
?>

<article class="amp-wp-article entry-article">
	<div class="container">
		<header class="amp-wp-article-header entry-header">
			<?php
			if ( $theme::$options['post_cats'] ) {
				?>
				<div class="amp-wp-categories entry-categories">
					<?php
					echo $category_fn();
					?>
				</div>
				<?php
			}
			?>
			<h1 class="amp-wp-article-title entry-title">
				<?php
				the_title();
				?>
			</h1>
			<ul class="amp-wp-article-meta entry-meta">
				<?php
				if ( $theme::$options['post_author_name'] ) {
					?>
					<li class="amp-wp-article-author item-author">
						<span><?php esc_html_e( 'By ', 'radius-amp' ); ?></span>
						<a href="<?php echo esc_url( get_author_posts_url( $post_author->ID ) ); ?>">
							<?php echo esc_html( get_the_author_meta( 'display_name', $post_author->ID ) ); ?>
						</a>
					</li>
					<?php
				}

				if ( $theme::$options['post_date'] ) {
					?>
					<li><i class="far fa-calendar-alt"></i><?php echo get_the_date(); ?></li>
					<?php
				}

				if ( $theme::$options['post_comment_num'] ) {
					?>
					<li><i class="far fa-comments"></i><?php echo wp_kses( $comments_html, 'alltext_allow' ); ?></li>
					<?php
				}

				if ( $theme::$options['post_length'] && function_exists( $reading_time_fn ) ) {
					?>
					<li class="meta-reading-time meta-item"><i class="far fa-clock"></i><?php echo $reading_time_fn(); ?></li>
					<?php
				}

				if ( $theme::$options['post_view'] && function_exists( $post_views_fn ) ) {
					?>
					<li><i class="fas fa-signal"></i><span class="meta-views meta-item "><?php echo $post_views_fn(); ?></span></li>
					<?php
				}

				if ( $theme::$options['post_published'] && function_exists( $human_time_fn ) ) {
					?>
					<li><i class="fas fa-clock"></i><?php echo $human_time_fn(); ?></li>
					<?php
				}
				?>
			</ul>
			<?php
			if ( $theme::$options['post_share'] && function_exists( $post_share_fn ) ) {
				?>
				<div class="amp-wp-article-share post-share">
					<?php
					$post_share_fn();
					?>
				</div>
				<?php
			}

			if ( $theme::$options['post_featured_image'] == true ) {
				?>
				<div class="amp-wp-article-thumbnail entry-thumbnail">
					<figure class="amp-wp-article-featured-image wp-caption">
						<?php
						$caption = get_post( get_post_thumbnail_id() )->post_excerpt;
						the_post_thumbnail( "$theme_prefix-size1", array( 'class' => 'img-responsive' ) );
						?>
						<?php
						if ( $caption ) {
							?>
							<p class="wp-caption-text">
								<?php echo wp_kses_data( $caption ); ?>
							</p>
							<?php
						}
						?>
					</figure>
				</div>
				<?php
			}
			?>
		</header>

		<div id="main" class="amp-wp-article-content">
			<?php
			do_action( 'rt_amp_before_post_content', $this );

			while ( have_posts() ) {
				the_post();
				?>
				<div class="entry-article-content entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'radius-amp' ),
							'after'       => '</div>',
							'link_before' => '<span class="page-number">',
							'link_after'  => '</span>',
						)
					);
					?>
				</div>

				<?php
				if ( 'video' === get_post_format( get_the_id() ) && ! empty( $youtube_link ) ) {
					preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $youtube_link, $match );
					$youtube_id = $match[1];
				}

				if ( ! empty( $youtube_id ) ) {
					if ( 'video' === get_post_format( get_the_id() ) ) {
						?>
						<div class="entry-content entry-thumbnail-area embed-responsive-16by9 content-video">
							<div class="embed-responsive">
								<amp-youtube class="embed-responsive-item" data-videoid="<?php echo esc_attr( $youtube_id ); ?>" layout="responsive" width="600" height="338"></amp-youtube>
							</div>
						</div>
						<?php
					}
				}
			}

			do_action( 'rt_amp_after_post_content', $this );
			?>
		</div>

		<footer class="amp-wp-article-footer entry-footer">
			<?php
			if ( ( $theme::$options['post_tags'] && has_tag() ) || ( $theme::$options['post_share'] && ( function_exists( $post_share_fn ) ) ) ) {
				?>
				<div class="entry-footer-meta">
					<?php
					if ( $theme::$options['post_tags'] && has_tag() ) {
						?>
						<div class="meta-tags">
							<h4 class="meta-title"><?php esc_html_e( 'Tags:', 'radius-amp' ); ?></h4>
							<?php
							echo get_the_term_list( $this->get( 'post' )->ID, 'post_tag', '' );
							?>
						</div>
						<?php
					}

					if ( $theme::$options['post_share'] && function_exists( $post_share_fn ) ) {
						?>
						<div class="post-share">
							<h4 class="meta-title"><?php esc_html_e( 'Share This Post:', 'radius-amp' ); ?></h4>
							<?php
							$post_share_fn();
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</footer>
	</div>

</article>
