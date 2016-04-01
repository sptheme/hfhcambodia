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
