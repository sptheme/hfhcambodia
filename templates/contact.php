<?php
/**
 * Template Name: Contact
 *
 * This is the template that displays custom contact page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

get_header(); 

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		
			<div class="wpsp-row clearfix">
				<div class="col span_2_of_3">
					<?php $args = array(
						    'type'         => 'map',
						    'width'        => '100%', // Map width, default is 640px. Can be '%' or 'px'
						    'height'       => '420px', // Map height, default is 480px. Can be '%' or 'px'
						    'js_options'   => array(
						        'zoom'        => 16, // You can use 'zoom' inside 'js_options' or as a separated parameter
						    )
						);
						echo rwmb_meta( 'wpsp_marker', $args ); // For current post 
					?>
				</div>
				<div class="col span_1_of_3">
					<?php if ( is_active_sidebar( 'contact-sidebar' ) ) dynamic_sidebar( 'contact-sidebar' ); ?>
				</div>
			</div> <!-- .wpsp-rwo -->
			
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php get_footer(); ?>