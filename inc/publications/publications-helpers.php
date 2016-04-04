<?php 
/**
 * Useful global functions for the publications
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme publications category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_publications_tax' ) ) {
	function wpsp_is_publications_tax() {
		if ( ! is_search() && ( is_tax( 'publications_category' ) || is_tax( 'publications_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}