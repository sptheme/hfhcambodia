<?php 
/**
 * Useful global functions for the portfolio
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checks if on a theme portfolio category page.
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_is_portfolio_tax' ) ) {
	function wpsp_is_portfolio_tax() {
		if ( ! is_search() && ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_province' ) || is_tax( 'portfolio_tag' ) ) ) {
			return true;
		} else {
			return false;
		}
	}
}