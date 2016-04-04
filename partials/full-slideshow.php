<?php
/**
 * Template part for displaying fullslidshow on page header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */


$images = rwmb_meta( 'wpsp_slideshow', array('type' => 'image_advanced'), $post->ID ); 
if ( !empty($images) ) : ?>

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
	<div class="site-slider container">
		<div id="slides">
		    <ul class="slides-container">
		<?php foreach ( $images as $image ) : ?>    
		        <li><img src="<?php echo $image['full_url']; ?>" alt="$image['alt']"></li>
		<?php endforeach; ?>        
			</ul>
			<nav class="slides-navigation">
				<a href="#" class="next"><i class="fa fa-chevron-right"></i></a>
				<a href="#" class="prev"><i class="fa fa-chevron-left"></i></a>
			</nav>
		</div> <!-- #slides -->	
	</div> <!-- .site-slider -->
	
<?php endif; ?>