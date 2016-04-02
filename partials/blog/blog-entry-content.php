<?php
/**
 * Template part for displaying blog entry excerpt.
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
$excerpt_length = wpsp_get_redux( 'blog-excerpt-length', 40 );

// Return if excerpt length is set to 0
if ( '0' == $excerpt_length ) {
	return;
} ?>

<div class="blog-entry-excerpt">
	<?php wpsp_excerpt( array(
		'length'   => $excerpt_length,
		'readmore' => true,
	) ); ?>
</div><!-- .entry-excerpt -->