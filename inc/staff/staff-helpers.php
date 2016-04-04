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
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_staff_tax' ) ) {
	function wpsp_is_staff_tax() {
		if ( ! is_search() && ( is_tax( 'staff_category' ) || is_tax( 'staff_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}