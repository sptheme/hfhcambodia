<?php
/**
 * Setup theme hooks and action
 *
 * @package     Learning_Institute
	 * @since       Learning Institute 1.0.0
 */
/**
 * Main Content Hooks
 *
 * @since Discover Travel 1.0.0
 */
function wpsp_hook_content_top() {
    do_action( 'wpsp_hook_content_top' );
}
function wpsp_hook_content_bottom() {
    do_action( 'wpsp_hook_content_bottom' );
}

/**
 * Get custom page header template part, will apply on top of post/page
 */
function wpsp_page_header() {
	if ( is_page_template( 'templates/what-we-build.php' ) ) {
		get_template_part( 'partials/page-header' );	
	}
}
add_action( 'wpsp_hook_content_top', 'wpsp_page_header' );

/**
 * Display full slideshow on page header
 */
function wpsp_full_slideshow() {
	if ( is_page_template( 'templates/homepage.php' ) ) {
		get_template_part( 'partials/full-slideshow' );
	}
}
add_action( 'wpsp_hook_content_top', 'wpsp_full_slideshow' );