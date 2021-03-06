<?php
/**
 * Template Name: Homepage
 *
 * This is the template that displays landing homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

get_header(); ?>

	<?php // Loop page
	while ( have_posts() ) : the_post(); ?>

		<?php if ( is_active_sidebar( 'home-sidebar' ) ) : ?>
		<section id="home-sidebar-1" class="home-sidebar-1">
			<div class="container">
			<?php dynamic_sidebar( 'home-sidebar' ); ?>
			</div>
		</section> <!-- .home-sidebar-1 -->
	<?php endif; ?>

		<section class="our-work">
			<div class="container">
				<header class="section-title">
				<?php if ( rwmb_meta('wpsp_program_headline_home') ) : ?>
		            <h2><?php echo esc_html( rwmb_meta('wpsp_program_headline_home') ); ?></h2>
		        <?php endif; ?>    
		        <?php if ( rwmb_meta('wpsp_program_desc_home') ) : ?>
		            <p class="description"><?php echo esc_html( rwmb_meta('wpsp_program_desc_home') ); ?></p>
		        <?php endif; ?>    
		        </header>
		        <?php if ( rwmb_meta('wpsp_main_program_page_home' ) ) : ?>
		        <div class="featured-page wpsp-row clear">
		    	<?php
		    		$page_count = 0;
		    		$cols = 3;
		    		$args = array (
						'child_of' => rwmb_meta('wpsp_main_program_page_home'),
						'sort_column' => 'menu_order',
					); 
					$featured_pages = get_pages( $args );
					if ( !empty($featured_pages) ) {
						foreach ( $featured_pages as $page ) { 
							$page_count++;
							$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
			            	if ( $page_count == 1 ) {
			            		$image_url = aq_resize( $thumb_url[0], '415', '585', true);
			            	} else {
			            		$image_url = aq_resize( $thumb_url[0], '415', '271', true);
			            	}
			            	if ( $page_count <= 5 ) { 
			            		$entry_classes = array( 'page-entry-overlay' );
								$entry_classes[] = 'col';
								$entry_classes[] = wpsp_grid_class($cols); 
								$entry_classes[] = 'col-' . $page_count; ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
									<div class="wpsp-image-hover grow overlay-parent">
										<a href="<?php wpsp_permalink($page->ID);?>" rel="bookmark">
										<img src="<?php echo $image_url;?>">
										<div class="overlay-headline headline-wrap">
											<span class="title headline-inner gradient-background"><?php echo $page->post_title; ?></span>
										</div>
										</a>	
									</div>
								</article> <!-- .page-entry-overlay -->

			            <?php }
						} 
					}?>
		        </div> <!-- .featured-page .clear -->
		    	<?php endif; ?>
	    	</div> <!-- .container -->
		</section> <!-- .our-work -->

		<section class="latest-testimonial">
			<div class="container">
				<header class="section-title">
				<?php if ( rwmb_meta('wpsp_testimonial_headline_home') ) : ?>
		            <h2><?php echo esc_html( rwmb_meta('wpsp_testimonial_headline_home') ); ?></h2>
		        <?php endif; ?> 

		        <?php // Highlight post
				$terms = rwmb_meta('wpsp_testimonial_category', array( 'type' => 'taxonomy_advanced', 'taxonomy' => 'testimonials_category'), $post->ID);
				$cats_ids = array();
				if ( !empty($terms) ) {
					foreach ( $terms as $term ) {
						$cats_ids[] = $term->term_id;
					}
				}
				$args = array(
						'post_type' => 'testimonials',
						'posts_per_page' => 1,
						'tax_query' => array( 
							array(
					            'taxonomy' => 'testimonials_category',
					            'field' => 'term_id',
					            'terms' => $cats_ids,
					            'operator' => 'IN'
					           )
						)
					);
				$testimonial_query = new WP_Query($args);

				if ( $testimonial_query->have_posts() ) : 
					while ( $testimonial_query->have_posts() ) : $testimonial_query->the_post();  ?>
						<div class="testimonial-entry-content clear">
							<?php if ( wpsp_get_redux( 'is-testimonial-entry-title', true ) ) : ?>
								<h2 class="testimonial-entry-title entry-title clear">
									<?php the_title(); ?>
								</h2><!-- .testimonial-entry-title -->
							<?php endif; ?>
							<div class="testimonial-entry-text">
								<?php the_content(); ?>
							</div><!-- .testimonial-entry-text -->
						</div><!-- .home-testimonial-entry-content-->
						<div class="testimonial-entry-bottom">
							<?php get_template_part( 'partials/testimonials/testimonials-entry-avatar' ); ?>
							<?php get_template_part( 'partials/testimonials/testimonials-entry-meta' ); ?>
						</div>

					<?php endwhile; wp_reset_postdata(); 
				endif; ?>

			</div> <!-- .container -->
		</section> <!-- .testimonial -->        

		<?php // Highlight post
			$terms = rwmb_meta('wpsp_highlight_category', array( 'type' => 'taxonomy_advanced', 'taxonomy' => 'category'), $post->ID);
			$cats_ids = array();
			if ( !empty($terms) ) {
				foreach ( $terms as $term ) {
					$cats_ids[] = $term->term_id;
				}
			}
			
			$args = array(
					'post_type' => 'post',
					'posts_per_page' => 1,
					'category__in'   => $cats_ids,
				);
			$highlight_query = new WP_Query($args);

			if ( $highlight_query->have_posts() ) : 
				while ( $highlight_query->have_posts() ) : $highlight_query->the_post(); 
			
				// show icon by post format
				$post_format = get_post_format();
				$format_standard = '<span class="overlay-article-hover overlay-font-icon"></span>'; 
				$format_video = '<span class="overlay-video-hover overlay-font-icon"></span>';
				$popup_link = ( $post_format == 'video' ) ? wpsp_get_post_video() : wpsp_get_permalink();
				$popup_class = ( $post_format == 'video' ) ? 'popup-youtube' : 'popup-none';
				$post_icon = ( $post_format == 'video' ) ? $format_video : $format_standard;  ?>

		<section class="highlight-post-wrap">
			<div class="container">
				<div <?php post_class( array('highlight-post', 'wpsp-row', 'clear') ); ?>>
				<div class="col span_1_of_2">
					<div class="wpsp-image-hover grow overlay-parent">
					<?php printf( '<a class="%1$s" itemprop="url" href="%2$s" rel="bookmark" title="%3$s">%4$s %5$s</a>', 
						$popup_class,
						$popup_link, 
						wpsp_get_esc_title(), 
						wpsp_get_post_thumbnail_total( array(
							'size'   => 'thumb-landscape',
							'alt'    => wpsp_get_esc_title(),
						) ),
						$post_icon  
					); ?>
					</div> <!-- .wpsp-image-hover -->
				</div>
				<div class="col span_1_of_2">
					<span class="highlight green"><?php the_category( ', ', get_the_ID() );?></span>
					<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>
					<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
					<?php get_template_part( 'partials/blog/blog-entry-content' ); ?>
				</div>
				</div> <!-- .highlight-post -->
			</div> <!-- .container -->
		</section>
		<?php endwhile; wp_reset_postdata(); 
		endif; ?>

		<?php // Latest Post exclude video post format
		$post_count = rwmb_meta('wpsp_latest_post_number');
		$args = array(
				'post_type' => 'post',
				'posts_per_page' => $post_count,
				'tax_query' => array( 
					'relation' => 'AND',
					array(
			            'taxonomy' => 'category',
			            'field' => 'term_id',
			            'terms' => $cats_ids,
			            'operator' => 'NOT IN'
			           ),
					array(
			            'taxonomy' => 'post_format',
			            'field' => 'slug',
			            'terms' => array('post-format-video'),
			            'operator' => 'NOT IN'
			           ) 
				)
			);
		$post_query = new WP_Query($args);

		if ( $post_query->have_posts() ) : ?>
		<section class="latest-post-wrap">
			<div class="container">
				<div class="latest-post <?php wpsp_blog_wrap_classes(); ?> wpsp-row">
					<?php if ( is_active_sidebar( 'home-sidebar-2' ) ) : ?>
					<div class="col span_2_of_3">
					<?php endif; ?>
						<header class="section-title">
							<h2><?php echo rwmb_meta('wpsp_latest_post_headline'); ?></h2>
						</header>
						<?php  
						$classes = wpsp_blog_entry_classes();
						while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
							<?php get_template_part( 'partials/blog/media/blog-entry' ); ?>
							<div class="blog-entry-content entry-details">
								<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>
								<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
								<div class="blog-entry-excerpt">
									<?php wpsp_excerpt( array(
										'length'   => 20,
										'readmore' => false,
									) ); ?>
								</div>
							</div>	
							</article>
						<?php endwhile; wp_reset_postdata(); ?>
						<a class="archive-link" href="<?php echo get_permalink( rwmb_meta('wpsp_post_archive_page') ); ?>"><?php echo esc_html('Other Builds Activities', 'hfhcambodia'); ?> <i class="fa fa-angle-double-right"></i></a>
					<?php if ( is_active_sidebar( 'home-sidebar-2' ) ) : ?>	
					</div> <!-- .col .span_2_of_3 -->
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'home-sidebar-2' ) ) : ?>
					<div id="home-sidebar-2" class="col span_1_of_3">
						<?php dynamic_sidebar( 'home-sidebar-2' ); ?>
					</div> <!-- .col .span_1_of_3 -->
					<?php endif; ?>
				</div>
			</div> <!-- .container -->
		</section> <!-- .latest-post-wrap -->
		<?php endif; // end loop - latest post ?>

		<?php // Latest Publication post type
		$post_number = rwmb_meta('wpsp_pub_post_number');
		$args = array(
				'post_type' => 'publications',
				'posts_per_page' => $post_number,
			);
		$publication_query = new WP_Query($args);

		if ( $publication_query->have_posts() ) : ?>
		<section class="publications-wrap">
			<div class="container">
			<div class="latest-publications wpsp-row clear">
				<header class="section-title">
					<h2><?php echo rwmb_meta('wpsp_publication_headline'); ?></h2>
				</header>

				<?php while ( $publication_query->have_posts() ) : $publication_query->the_post(); ?>
					<div class="col span_1_of_2">
					<?php get_template_part( 'partials/publication/publication-entry-layout' ); ?>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>	
			</div>
		</section>
		<?php endif; // end loop - latest publication ?>

	<?php endwhile; // End of the loop page. ?>

<?php get_footer(); ?>