<?php 
/**
 * Useful global functions for the career
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme career category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_career_tax' ) ) :
	function wpsp_is_career_tax() {
		if ( ! is_search() && ( is_tax( 'career_category' ) || is_tax( 'career_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
endif;

/**
 * Add Event passed class to event header
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'wpsp_event_passed_class' ) ) :
	function wpsp_event_passed_class( $post_id ) {
		$classes = array();
		$datetime = get_post_meta( $post_id, 'wpsp_event_datetime', true );
		
		if ( !$datetime ) {
			return;
		}

		$datetime = explode( ' ' , $datetime );
		$classes[] = ( $datetime[0] < date('Y-m-d h:i') ) ? 'passed-event' : 'progress-event';

		// Apply filters for child theming
		$classes = apply_filters( 'wpsp_event_passed_class', $classes );

		return $classes;
	}
endif;

/**
 * Retur job type class
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpsp_career_type_class' ) ) :
	function wpsp_career_type_class() {
		$career_type_obj = rwmb_meta( 'wpsp_career_type' );
		$career_type = wpsp_get_term_name_by_id( $career_type_obj->term_id, 'career_type' );
		$career_class = str_replace(' ', '-', strtolower($career_type));
		
		return $career_class;
	}
endif;