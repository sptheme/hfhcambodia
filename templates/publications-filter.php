<?php
/**
 * Template Name: Publications Filter
 *
 * This is the template that display result by custom query sting.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

get_header(); 
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<header class="entry-header">
				<h3 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'learninginstitute' ), '<span>' . $_GET['p'] . '</span>' ); ?></h3>
			</header><!-- .page-header -->

			<section class="entry-content">
				<?php the_content(); ?>
			</section> <!-- .about-entry-content -->

			<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
				$args = array(
	    			'post_type' 	=> 	'publications', 
				    's' 			=> 	$_GET['p'], 
				    'paged' 		=> $paged
		    	); 
		    	$custom_query = new WP_Query($args);

				if ( $custom_query->have_posts() ) { ?>
				<div class="filter-pages">
					<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); 
						$entry_classes = array( 'entry-publication-article' ); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
							<?php get_template_part( 'template-parts/publication/publication-entry-media' ); ?>
							<?php get_template_part( 'template-parts/publication/publication-entry-title' ); ?>	
							<?php get_template_part( 'template-parts/publication/publication-entry-meta' ); ?>
						</article><!-- #post-## -->
					<?php endwhile; wp_reset_postdata(); 
						// Pagination
	                    if(function_exists('wp_pagenavi'))
	                        wp_pagenavi();
	                    else 
	                        wpsp_paging_nav(); ?>
				</div> <!-- .wpsp-row .clearfix -->
				<?php	
				} else { ?>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'learninginstitute' ); ?></p>
					<form role="search" method="get" class="search-form" action="<?php wpsp_permalink(); ?>">
						<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'wpsp_admin' ); ?>" value="<?php if(!empty($_GET['p'])) echo $_GET['p']; ?>" name="p" title="<?php echo esc_attr_x( 'Search for:', 'label', 'wpsp_admin' ); ?>" />
						<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'wpsp_admin' ); ?></span></button>
					</form>
				<?php } ?>
			</section> <!-- .filter-pages -->
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();