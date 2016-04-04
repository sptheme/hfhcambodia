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
if ( ! function_exists( 'wpsp_is_testimonials_tax' ) ) {
	function wpsp_is_testimonials_tax() {
		if ( ! is_search() && ( is_tax( 'testimonials_category' ) || is_tax( 'testimonials_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}