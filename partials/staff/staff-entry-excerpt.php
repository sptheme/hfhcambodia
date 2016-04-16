<?php
/**
 * Template part for displaying staff entry excerpt.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Get excerpt length
$excerpt_length = wpsp_get_redux( 'staff-entry-excerpt-length', '20' );

// Return if excerpt length is set to 0
if ( '0' == $excerpt_length ) {
	return;
} ?>

<div class="staff-entry-excerpt clear">
	<?php wpsp_excerpt( array(
		'length'   => $excerpt_length,
		'readmore' => false,
	) ); ?>
</div><!-- .staff-entry-excerpt -->
