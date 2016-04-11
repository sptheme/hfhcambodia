<?php 
/**
 * Useful global functions for the slider
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme slider category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_slider_tax' ) ) {
	function wpsp_is_slider_tax() {
		if ( ! is_search() && ( is_tax( 'slider_category' ) || is_tax( 'slider_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}