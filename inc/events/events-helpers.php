<?php 
/**
 * Useful global functions for the events
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme events category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_events_tax' ) ) {
	function wpsp_is_events_tax() {
		if ( ! is_search() && ( is_tax( 'events_category' ) || is_tax( 'events_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}