<?php
/**
 * Template Name: Project
 *
 * This is the template that displays custom about page.
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
			<?php if ( rwmb_meta( 'wpsp_masthead_title') ) : ?>
			<header class="entry-header">
				<h2 class="entry-title"><?php echo rwmb_meta( 'wpsp_masthead_title'); ?></h2>
			</header><!-- .entry-header -->
			<?php endif; ?>

			<section class="entry-content">
				<?php the_content(); ?>
			</section> <!-- .entry-content -->

		<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
    			'post_type' 	=> 	'portfolio',
			    'paged' 		=> $paged
	    	); 
	    	$custom_query = new WP_Query($args);

			if ( $custom_query->have_posts() ) { ?>
			<div class="portfolio-list-wrap wpsp-row clearfix">
				<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
				<?php get_template_part( 'template-parts/portfolio/portfolio-entry-layout' ); ?>
				<?php endwhile; wp_reset_postdata(); 
					// Pagination
                    if(function_exists('wp_pagenavi'))
                        wp_pagenavi();
                    else 
                        wpsp_paging_nav(); ?>
			</div> <!-- .wpsp-row .clearfix -->		
			<?php } else {
				echo esc_html__( 'Sorry, new content will coming soon.', 'learninginstitute' );
				} ?>
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();