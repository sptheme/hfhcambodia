<?php
/**
 * Slide Up Title White Overlay
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
} ?>

<div class="overlay-slideup-title overlay-hide white clear theme-overlay">
	<span class="title">
		<?php if ( 'staff' == get_post_type() ) {
			echo get_post_meta( get_the_ID(), 'wpsp_staff_position', true );
		} else {
			the_title();
		} ?>
	</span>
</div>