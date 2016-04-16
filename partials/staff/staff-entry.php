<?php
/**
 * Template part for displaying staff entry post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Counter for clearing floats and margins
if ( ! isset( $related_query ) ) {
	global $post_count;
	$query = 'archive';
} else {
	$query = 'related';
}

// Add Standard Classes
$classes   = array();
$classes[] = 'staff-entry';
$classes[] = 'col';
$classes[] = wpsp_staff_column_class( $query );;
$classes[] = 'col-'. $post_count; 

// Get grid style
$wpsp_grid_style = wpsp_get_redux( 'staff-archive-grid-style', 'fit-rows' );

// Masonry Classes
if ( 'archive' == $query && in_array( $wpsp_grid_style, array( 'masonry', 'no-margins' ) ) ) {
	$classes[] = ' isotope-entry';
} ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="staff-entry-inner">
	<?php get_template_part( 'partials/staff/staff-entry-media' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry-content' ); ?>
	</div> <!-- .staff-entry-inner -->
</article><!-- .staff-entry -->
