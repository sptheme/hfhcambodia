<?php
/**
 * Template part for displaying fullslidshow on page header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Posts count
$posts_count = 5;

// Query args
$terms = rwmb_meta('wpsp_slide_category', array( 'type' => 'taxonomy', 'taxonomy' => 'slider_category'), $post->ID );

$cats_ids = array();
if ( !empty($terms) ) {
	foreach ( $terms as $term ) {
		$cats_ids[] = $term->term_id;
	}
}
$args = array(
	'post_type'		 => 'slider',
	'posts_per_page' => $posts_count,
	'tax_query'      => array (
		array (
			'taxonomy' => 'slider_category',
			'field'    => 'term_id',
			'terms'    => $cats_ids,
			'operator' => 'IN',
		),
	),
);

$args = apply_filters( 'wpsp_slider_post_args', $args );

// Run Query - must be set to $wpex_related_query var!!
$slider_query = new wp_query( $args );

// If posts were found display related items
if ( $slider_query->have_posts() ) : ?>

	<script type="text/javascript">
	    jQuery(document).ready(function($){
	        $('#slides').superslides({
	        	play: 5000,
			    animation_speed: 600,
			    animation_easing: 'swing',
			    animation: 'slide',
		        inherit_width_from: '.site-slider',
		        inherit_height_from: '.site-slider'
		      });
	    });     
	</script>
	<div class="slider-wrap">
		<div class="site-slider container">
			<div id="slides">
			    <ul class="slides-container">
			<?php foreach ( $slider_query->posts as $post ) : setup_postdata( $post ); ?>    
			        <li>
			        <?php // Get slider meta
			        $slide_link = rwmb_meta('wpsp_slide_link');
					$slide_link_target = rwmb_meta('wpsp_slide_link_target'); ?>
					
			        <?php if ( !empty($slide_link) ) : ?>
			        	<a href="<?php echo esc_url($slide_link); ?>" target="<?php echo esc_attr($slide_link_target); ?>">
			        <?php endif; ?>	
			        	<?php wpsp_post_thumbnail_total( array(
							'size'   => 'thumb-full',
							'alt'    => wpsp_get_esc_title(),
						) ); ?>
					<?php if ( !empty($slide_link) ) : ?>
			        	</a>
			        <?php endif; ?>		
			        </li>
			<?php endforeach; ?>        
				</ul>
				<nav class="slides-navigation">
					<a href="#" class="next"><i class="fa fa-chevron-right"></i></a>
					<a href="#" class="prev"><i class="fa fa-chevron-left"></i></a>
				</nav>
			</div> <!-- #slides -->	
		</div> <!-- .site-slider -->
	</div> <!-- .slider-wrap -->
	
<?php endif; ?>