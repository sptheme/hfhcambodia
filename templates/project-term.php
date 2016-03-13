<?php
/**
 * Template Name: Project Term
 *
 * This is the template that displays custom about page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
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
			$terms = apply_filters( 'taxonomy-images-get-terms', '', array( 
																'having_images' => false,					
																'taxonomy' => 'portfolio_tag', 
																'term_args' => array( 
																				'order' => 'DESC',
																				//'hide_empty' => 0
																			)
																	) 
																);

			/*$args = array( 
					'order' => 'DESC',
					'hide_empty' => 0
				);
 
			$terms = get_terms( 'portfolio_tag', $args );*/ 

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { ?>
			<div class="portfolio-term-wrap wpsp-row clearfix">
				<?php $term_list = '';
				foreach ( (array) $terms as $term ) {
						$term_list .= '<article class="portfolio-entry-article post-highlight col span_1_of_3">';
						if ( !empty($term->image_id) ) {
							$term_list .= sprintf( '<div class="post-thumbnail"><a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a></div>', 
								esc_url( get_term_link( $term ) ), 
								esc_attr( sprintf( __( 'View all post filed under %s', 'learninginstitute' ), $term->name ) ), 
								wp_get_attachment_image( $term->image_id, 'thumb-landscape' )  
							);
						} else {
							$term_list .= sprintf( '<div class="post-thumbnail"><a itemprop="url" href="%1$s" rel="bookmark" title="%2$s">%3$s</a></div>', 
								esc_url( get_term_link( $term ) ), 
								esc_html($term->name ), 
								wpsp_post_thumbnail('thumb-landscape')  
							);
						}
						$term_list .= '<div class="portfolio-entry-content">';
						$term_list .= '<h3 class="entry-title portfolio-entry-title">';
						$term_list .= '<a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'learninginstitute' ), $term->name ) ) . '">' . esc_html( sprintf( __( 'Projects in %s', 'learninginstitute' ), $term->name ) ) . '</a>';
						$term_list .= '</h3>';
						if ( !empty($term->description) ) {
							$term_list .= '<div class="portfolio-entry-excerpt">' . $term->description . '</div>';
						}
						$term_list .= '</div>';
						$term_list .= '</article>';
					} 
				echo $term_list; ?>
			</div> <!-- .wpsp-row .clearfix -->		
			<?php } else {
				echo esc_html__( 'Sorry, new content will coming soon.', 'learninginstitute' );
				} ?>
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();