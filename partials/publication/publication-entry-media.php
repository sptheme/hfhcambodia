<?php
/**
 * Template part for displaying publication entry media.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

$img_size = 'thumb-portrait'; ?>

<div class="publication-entry-media entry-media">
	
	<?php wpsp_post_thumbnail_total( array(
			'size'   => $img_size,
			'width'  => '90',
			'height' => '140',
			'alt'    => wpsp_get_esc_title(),
		) ); ?>

</div> <!-- #post-media -->