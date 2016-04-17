<?php
/**
 * Template Name: Featured videos
 *
 * This is the template that landing video posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

get_header(); 

	$about_meta = get_post_meta( $post->ID );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!-- <header class="entry-header">
				<?php $title_align = get_post_meta( get_the_ID(), 'wpsp_post_title_align', true ); ?>
				<h1 class="entry-title" style="text-align:<?php echo $title_align; ?>"><?php the_title(); ?></h1>
			</header> --><!-- .entry-header -->

			<!-- <section class="entry-content">
				<?php the_content(); ?>
			</section> --> <!-- .about-entry-content -->

			<section class="featured-video-posts">
			<?php // setup cols
				$post_count = 0;
				$post_excerpt = 1;
				$excerpt_length = 25;
				$term_id = ( rwmb_meta('wpsp_featured_video_cat') ) ? rwmb_meta('wpsp_featured_video_cat') : 3;
				$post_style = '';
				$entry_classes = array( 'blog-entry' ); 
				$entry_classes[] = $post_style;

				$args = array (
					'post_type' => 'post',
					'category__in' => $term_id,
					'posts_per_page' => 1,
					'tax_query' => array( 
							array(
					            'taxonomy' => 'post_format',
					            'field' => 'slug',
					            'terms' => array('post-format-video'),
					            'operator' => 'IN'
					          )
						)
				); 
				$featured_video = new WP_Query($args);

				if ( $featured_video->have_posts() ) { ?>
				<div class="featured-video">
				<?php while ( $featured_video->have_posts() ) : $featured_video->the_post(); 
						$post_count++;
						$entry_classes[] = 'col-' . $post_count; ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
							<div class="wpsp-row no-margin-grid clear">
								<div class="col span_2_of_3">
								<?php get_template_part( 'partials/blog/media/blog-entry' ); ?>
								</div> <!-- .col .span_2_of_3 -->
								<div class="col span_1_of_3">
									<div class="blog-entry-wrap">
										<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>
										<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
										<?php get_template_part( 'partials/blog/blog-entry-content' ); ?>
									</div> <!-- .blog-entry-wrap -->
								</div><!-- .col .span_1_of_3 -->	
							</div> <!-- .wpsp-row .clear -->
						</article>	
				<?php endwhile; wp_reset_postdata(); ?>
				</div> <!-- .featured-video -->
				<?php } ?>
			</section> <!-- .featured-video-posts -->

			<?php // Video Posts
				$cols = 3;
				$post_count = 0;
				$entry_classes[] = 'col';
				$entry_classes[] = wpsp_grid_class($cols);
				$args = array (
					'post_type' => 'post',
					'category__in' => $term_id,
					'tax_query' => array( 
							array(
					            'taxonomy' => 'post_format',
					            'field' => 'slug',
					            'terms' => array('post-format-video'),
					            'operator' => 'IN'
					          )
						),
					'offset' => 1,
					'posts_per_page' => 9
				); 
				$video_query = new WP_Query($args);

				if ( $video_query->have_posts() ) { ?>

				<div class="video-posts wpsp-row clear">
				
				<?php while ( $video_query->have_posts() ) : $video_query->the_post(); 
						$post_count++;
						$entry_classes[] = 'col-' . $post_count; ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
							<div class="gray-highlight">	
								<?php get_template_part( 'partials/blog/media/blog-entry' ); ?>

								<div class="blog-entry-wrap">
									<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>
									<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
								</div> <!-- .blog-entry-wrap -->
							</div> <!-- .gray-highlight -->
								
						</article>	
				<?php endwhile; wp_reset_postdata(); ?>

				</div> <!-- .video-posts .wpsp-row .clear -->
				<?php // Pagination
			            if(function_exists('wp_pagenavi'))
			                wp_pagenavi();
			            else 
			                wpsp_paging_nav($video_query->max_num_pages); ?>
				<?php } ?>
				
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();