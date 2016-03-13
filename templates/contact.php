<?php
/**
 * Template Name: Contact
 *
 * This is the template that displays custom contact page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

get_header(); 

?>
	<header class="page-header-contact">
		<h2 class="entry-title"><?php the_title();?></h2>
		<?php if ( rwmb_meta('wpsp_contact_desc') ) : ?>
		<p class="description"><?php echo rwmb_meta('wpsp_contact_desc'); ?></p>
	<?php endif; ?>
	</header>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="wpsp-row clearfix">
				<div class="col span_2_of_3">
					<?php $args = array(
						    'type'         => 'map',
						    'width'        => '100%', // Map width, default is 640px. Can be '%' or 'px'
						    'height'       => '480px', // Map height, default is 480px. Can be '%' or 'px'
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
			<?php the_content(); ?>
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php get_footer(); ?>