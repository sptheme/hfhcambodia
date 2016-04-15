<?php 
/**
 * Useful global functions for the testimonials
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme testimonials category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_testimonials_tax' ) ) :
	function wpsp_is_testimonials_tax() {
		if ( ! is_search() && ( is_tax( 'testimonials_category' ) || is_tax( 'testimonials_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
endif;


/**
 * Returns correct thumbnail HTML for the testimonials entries
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_get_testimonials_entry_thumbnail' ) ) :
function wpsp_get_testimonials_entry_thumbnail() {
    return wpsp_get_post_thumbnail_total( array(
        'size'  => 'thumb-square',
        'class' => 'testimonials-entry-img',
        'alt'	=> wpsp_get_esc_title(),
    ) );
}
endif;

/**
 * Returns testimonials archive columns
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_testimonials_archive_columns' ) ) :
function wpsp_testimonials_archive_columns() {
	return wpsp_get_redux('testimonials-archive-columns', '3');
}
endif;

/**
 * Returns correct classes for the testimonials archive wrap
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_get_testimonials_wrap_classes' ) ) :
function wpsp_get_testimonials_wrap_classes() {

	// Define main classes
	$classes = array( 'wpsp-row', 'clear' );

	// Apply filters
	apply_filters( 'wpsp_testimonials_wrap_classes', $classes );

	// Turninto space seperated string
	$classes = implode( " ", $classes );

	// Return
	return $classes;

}
endif;