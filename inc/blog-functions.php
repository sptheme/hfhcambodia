<?php
/**
 * Helper functions for the blog
 *
 * @package Habitat Cambodia
 */

/**
 * Returns single blog post meta blocks
 *
 * @since 1.1.0
 * @return array
 */
if ( ! function_exists('wpsp_blog_single_meta_sections') ) :
function wpsp_blog_single_meta_sections() {

	// Default sections
	$sections = array( 'date' => 1, 'author' => 1, 'categories' => 1, 'comments' => 1 );

	// Get Sections from Customizer
	$sections = wpsp_get_redux( 'blog-post-meta-sections', $sections );

	// Apply filters for easy modification
	$sections = apply_filters( 'wpsp_blog_single_meta_sections', $sections );

	// Turn into array if string
	if ( $sections && ! is_array( $sections ) ) {
		$sections = explode( ',', $sections );
	}

	// Return sections
	return $sections;

}
endif;

/**
 * Returns blog entry meta blocks
 *
 * @since 1.1.0
 * @return array
 */
if ( ! function_exists('wpsp_blog_entry_meta_sections') ) :
function wpsp_blog_entry_meta_sections() {

	// Default sections
	$sections = array( 'date' => 1, 'author' => 1, 'categories' => 1, 'comments' => 1 );

	// Get Sections from Customizer
	$sections = wpsp_get_redux( 'blog-entry-meta-sections', $sections );

	// Apply filters for easy modification
	$sections = apply_filters( 'wpsp_blog_entry_meta_sections', $sections );

	// Turn into array if string
	if ( $sections && ! is_array( $sections ) ) {
		$sections = explode( ',', $sections );
	}

	// Return sections
	return $sections;

}
endif;

/**
 * Returns correct style for the blog entry based on theme options or category options
 *
 * @since 1.1.0
 */
if ( ! function_exists('wpsp_blog_entry_style') ) :
function wpsp_blog_entry_style() {

	// Get default style from Customizer
	$style = wpsp_get_redux('blog-entry-style');

	// Check custom category style
	/*if ( is_category() ) {
		$term       = get_query_var( "cat" );
		$term_data  = get_option( "category_$term" );
		if ( ! empty ( $term_data['wpsp_term_style'] ) ) {
			$style = $term_data['wpsp_term_style'] .'-entry-style';
		}
	}*/

	// Sanitize
	$style = $style ? $style : 'large-image-entry-style';

	// Apply filters for child theming
	$style = apply_filters( 'wpsp_blog_entry_style', $style );

	// Return style
	return $style;

}
endif;

/**
 * Returns correct blog entry classes
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_blog_entry_classes') ) :
function wpsp_blog_entry_classes() {

	// Define classes array
	$classes = array();

	// Entry Style
	$entry_style = wpsp_blog_entry_style();

	// Core classes
	$classes[] = 'blog-entry';
	$classes[] = 'clear';

	// Blog entry style
	$classes[] = $entry_style;

	// Apply filters to entry post class for child theming
	$classes = apply_filters( 'wpsp_blog_entry_classes', $classes );

	// Rturn classes array
	return $classes;
}
endif;

/**
 * Adds main classes to blog post entries
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_blog_wrap_classes') ) :
function wpsp_blog_wrap_classes( $classes = NULL ) {
	
	// Return custom class if set
	if ( $classes ) {
		return $classes;
	}
	
	// Admin defaults
	$style   = wpsp_blog_entry_style();
	$classes = array( 'entries', 'clear' );
		
	// Left thumbs
	if ( 'thumbnail-entry-style' == $style ) {
		$classes[] = 'left-thumbs';
	}

	// Add filter for child theming
	$classes = apply_filters( 'wpsp_blog_wrap_classes', $classes );

	// Turn classes into space seperated string
	if ( is_array( $classes ) ) {
		$classes = implode( ' ', $classes );
	}

	// Echo classes
	echo esc_attr( $classes );
	
}
endif;