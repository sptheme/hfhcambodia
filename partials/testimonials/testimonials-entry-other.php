<?php
/**
 * Template part for displaying testimonial entry meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Testimonial data
$other     = get_post_meta( get_the_ID(), 'wpsp_testimonial_other', true ); ?>

<?php if ( $other ) : ?>
	<span class="testimonial-entry-other"><?php echo $other; ?></span>
<?php endif; ?>