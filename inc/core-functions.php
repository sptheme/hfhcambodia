<?php
/**
 * Core theme functions
 *
 * These functions are used throughout the theme and must be loaded
 * early on.
 *
 * @package Habitat Cambodia
 */

/*-------------------------------------------------------------------------------*/
/* Table of contents
/*-------------------------------------------------------------------------------*/
	# General
	# Theme options (get value)

/*-------------------------------------------------------------------------------*/
/* General
/*-------------------------------------------------------------------------------*/

/**
 * Get Theme Branding
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_get_theme_branding' ) ) :
function wpsp_get_theme_branding( $branding = true ) {
	$fullname = WPSP_THEME_BRANDING;		
	$prefix = WPSP_THEME_BRANDING_PREFIX;
	if ( $branding ) {
		return $fullname;
	} else {
		return $prefix;
	}
}
endif;

/**
 * Limit characters on the title
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_limit_title_lenght' ) ) :
	function wpsp_limit_title_lenght($length, $replacer = '...') {
		 $string = the_title('','',FALSE);
		 if(strlen($string) > $length)
		 $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
		 echo $string;
	}
endif;


/*-------------------------------------------------------------------------------*/
/* Theme options (get value)
/*-------------------------------------------------------------------------------*/

/**
 * Returns theme options value from redux framework
 *
 * @since 1.0.0
 */
function wpsp_get_redux( $id, $default = '' ) {

	// Get global object
	global $redux_wpsp;

	// Return option value on customize_preview => IMPORTANT !!!
	/*if ( is_customize_preview() ) {
		return $redux_wpsp[$id];
	}*/

	// Return data from global object
	if ( ! empty( $redux_wpsp ) ) {

		// Return value
		if ( isset( $redux_wpsp[$id] ) ) {
			return $redux_wpsp[$id];
		}

		// Return default
		else {
			return $default;
		}

	}

	else {
		return $default;
	}

}