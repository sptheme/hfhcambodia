<?php 
/**
 * Useful global functions for the staff
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme staff category page.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_is_staff_tax' ) ) :
	function wpsp_is_staff_tax() {
		if ( ! is_search() && ( is_tax( 'staff_category' ) || is_tax( 'staff_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/**
 * Returns correct thumbnail HTML for the staff entries
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_get_staff_entry_thumbnail' ) ) :
function wpsp_get_staff_entry_thumbnail() {
	return wpsp_get_post_thumbnail_total( apply_filters( 'wpsp_get_staff_entry_thumbnail_args', array(
		'size'  => 'thumb-portrait',
		'class' => 'staff-entry-img',
		'alt'   => wpsp_get_esc_title(),
	) ) );
}
endif;

/**
 * Returns correct thumbnail HTML for the staff posts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_get_staff_post_thumbnail' ) ) :
function wpsp_get_staff_post_thumbnail() {
	return wpsp_get_post_thumbnail_total( apply_filters( 'wpsp_get_staff_post_thumbnail_args', array(
		'size'          => 'thumb-portrait',
		'class'         => 'staff-single-media-img',
		'alt'           => wpsp_get_esc_title(),
	) ) );
}
endif;

/**
 * Returns correct classes for the staff wrap
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_get_staff_wrap_classes' ) ) :
function wpsp_get_staff_wrap_classes() {

	// Define main classes
	$classes = array( 'wpsp-row', 'clr' );

	// Get grid style
	$grid_style = wpsp_get_redux( 'staff-archive-grid-style' );
	$grid_style =  $grid_style ? $grid_style : 'fit-rows';

	// Add grid style
	$classes[] = 'staff-'. $grid_style;

	// Apply filters
	apply_filters( 'wpsp_staff_wrap_classes', $classes );

	// Turninto space seperated string
	$classes = implode( " ", $classes );

	// Return
	return $classes;

}
endif;

/**
 * Returns staff archive columns
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_staff_archive_columns' ) ) :
function wpsp_staff_archive_columns() {
	return wpsp_get_redux( 'staff-entry-columns', '3' );
}
endif;

/**
 * Returns correct classes for the staff grid
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'wpsp_staff_column_class' ) ) :
	function wpsp_staff_column_class( $query ) {
		if ( 'related' == $query ) {
			return wpsp_grid_class( wpsp_get_redux( 'staff-related-columns', '3' ) );
		} else {
			return wpsp_grid_class( wpsp_get_redux( 'staff-entry-columns', '3' ) );
		}
	}
endif;