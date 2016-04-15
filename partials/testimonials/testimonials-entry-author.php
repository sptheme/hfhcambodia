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

// Display author if defined
if ( $author = get_post_meta( get_the_ID(), 'wpsp_testimonial_author', true ) ) : ?>
	<span class="testimonial-entry-author entry-title"><?php echo $author; ?></span>
<?php endif; ?>