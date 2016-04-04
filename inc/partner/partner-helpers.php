<?php 
/**
 * Useful global functions for the partner
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme partner category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_partner_tax' ) ) {
	function wpsp_is_partner_tax() {
		if ( ! is_search() && ( is_tax( 'partner_category' ) || is_tax( 'partner_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}