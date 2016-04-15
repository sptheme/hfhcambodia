<?php
/**
 * Template part for displaying entry testimonials entry post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Add classes to the entry
$classes   = array();
$classes[] = 'testimonial-entry';
$classes[] = 'col';
$classes[] = wpsp_grid_class(wpsp_testimonials_archive_columns()); ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php get_template_part( 'partials/testimonials/testimonials-entry-content' ); ?>
	<div class="testimonial-entry-bottom">
		<?php get_template_part( 'partials/testimonials/testimonials-entry-avatar' ); ?>
		<?php get_template_part( 'partials/testimonials/testimonials-entry-meta' ); ?>
	</div>
</article>
