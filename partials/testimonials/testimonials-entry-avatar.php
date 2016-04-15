<?php
/**
 * Template part for displaying testimonial entry avatar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Display thumbnail if defined
if ( $thumbnail = wpsp_get_testimonials_entry_thumbnail() ) : ?>

	<div class="testimonial-entry-thumb">
		<?php echo $thumbnail ?>
	</div><!-- /testimonial-thumb -->

<?php endif; ?>