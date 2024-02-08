<?php
/**
 * Template: Related Posts Slider.
 *
 * @package Radius_AMP
 */

$theme               = rttlp_amp()->theme_class();
$theme_prefix        = rttlp_amp()->theme_prefix();
$thumb_size          = "$theme_prefix-size3";
$post_id             = get_the_id();
$current_post        = array( $post_id );
$related_post_number = $theme::$options['show_related_post_number'];
$query_type          = $theme::$options['related_post_query'];

$args = array(
	'post__not_in'           => $current_post,
	'posts_per_page'         => ! empty( $related_post_number ) ? $related_post_number : 10,
	'no_found_rows'          => true,
	'post_status'            => 'publish',
	'ignore_sticky_posts'    => true,
	'update_post_term_cache' => false,
);

if ( $theme::$options['related_post_sort'] ) {
	$post_order = $theme::$options['related_post_sort'];

	if ( $post_order == 'rand' ) {
		$args['orderby'] = 'rand';
	} elseif ( $post_order == 'views' ) {
		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = 'neeon_views';
	} elseif ( $post_order == 'popular' ) {
		$args['orderby'] = 'comment_count';
	} elseif ( $post_order == 'modified' ) {
		$args['orderby'] = 'modified';
		$args['order']   = 'ASC';
	} elseif ( $post_order == 'recent' ) {
		$args['orderby'] = '';
		$args['order']   = '';
	}
}

if ( $query_type == 'author' ) {
	$args['author'] = get_the_author_meta( $this->get( 'post_author' )->ID );
} elseif ( $query_type == 'tag' ) {
	$tags_ids  = array();
	$post_tags = get_the_terms( $post_id, 'post_tag' );

	if ( ! empty( $post_tags ) ) {
		foreach ( $post_tags as $individual_tag ) {
			$tags_ids[] = $individual_tag->term_id;
		}

		$args['tag__in'] = $tags_ids;
	}
} else {
	$category_ids = array();
	$categories   = get_the_category( $post_id );

	foreach ( $categories as $individual_category ) {
		$category_ids[] = $individual_category->term_id;
	}

	$args['category__in'] = $category_ids;
}

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	?>
	<div class="wp-amp-related-posts">
		<div class="container">
			<div class="amp-related-posts">
				<div class="section-title">
					<h3 class="related-title">
						<?php echo wp_kses( $theme::$options['related_title'], 'alltext_allow' ); ?>
						<span class="titledot"></span>
						<span class="titleline"></span>
					</h3>
				</div>
				<div class="carousel-wrapper">
					<amp-base-carousel
						class="amp-carousel"
						layout="flex-item"
						role="region"
						loop="true"
						aria-label="Related Posts"
						visible-count="(min-width: 1200px) 3, (min-width: 768px) 2, 1"
						advance-count="(min-width: 1200px) 3, (min-width: 768px) 2, 1"
					>
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							$title_length  = $theme::$options['show_related_post_title_limit'] ? $theme::$options['show_related_post_title_limit'] : '';
							$trimmed_title = wp_trim_words( get_the_title(), $title_length, '' );

							$id      = get_the_ID();
							$content = get_the_content();
							$content = apply_filters( 'the_content', $content );
							$content = wp_trim_words( get_the_excerpt(), $theme::$options['post_content_limit'], '' );

							?>
							<div class="blog-box">
								<?php
								if ( has_post_thumbnail() || $theme::$options['display_no_preview_image'] == '1' ) {
									?>
									<div class="blog-img-holder">
										<div class="blog-img">
											<a href="<?php the_permalink(); ?>" class="img-opacity-hover">
												<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( $thumb_size, array( 'class' => 'img-responsive' ) );
												} else {
													if ( $theme::$options['display_no_preview_image'] == '1' ) {
														if ( ! empty( $theme::$options['no_preview_image']['id'] ) ) {
															$thumbnail = wp_get_attachment_image( $theme::$options['no_preview_image']['id'], $thumb_size );
														} elseif ( empty( $theme::$options['no_preview_image']['id'] ) ) {
															$thumbnail = '<img class="wp-post-image" src="' . rttlp_amp()->assets_url() . 'images/noimage_551X431.jpg" alt="' . the_title_attribute( array( 'echo' => false ) ) . '">';
														}
														echo wp_kses( $thumbnail, 'alltext_allow' );
													}
												}
												?>
											</a>
										</div>
									</div>
									<?php
								}
								?>
								<div class="entry-content">
									<?php
									if ( $theme::$options['blog_cats'] ) {
										?>
										<span class="entry-categories"><?php echo the_category( ', ' ); ?></span>
										<?php
									}
									?>
									<h4 class="entry-title title-animation-black-normal"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $trimmed_title ); ?></a></h4>
									<?php
									if ( $theme::$options['blog_date'] ) {
										?>
										<div class="entry-date"><i class="far fa-calendar-alt"></i><?php echo get_the_date(); ?></div>
										<?php
									}
									?>
								</div>
							</div>
							<?php
						}
						?>
						<button slot="next-arrow" class="carousel-next" aria-label="Next">
							<i class="fas fa-chevron-right"></i>
						</button>
						<button slot="prev-arrow" class="carousel-prev" aria-label="Previous">
							<i class="fas fa-chevron-left"></i>
						</button>
					</amp-base-carousel>
				</div>
			</div>
		</div>
	</div>
	<?php
	wp_reset_postdata();
}
