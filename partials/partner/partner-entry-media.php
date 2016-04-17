<?php
/**
 * Template part for displaying partner logo with link.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<?php 
$images = rwmb_meta( 'wpsp_partner_logo', array( 'type' => 'image_advanced', 'size' => 'large' ) );
$logo_url = (rwmb_meta('wpsp_partner_url')) ? rwmb_meta('wpsp_partner_url') : '#';
if ( $images ) {
	foreach ($images as $image ) {
		printf( '<a itemprop="url" href="%1$s" rel="bookmark" title="%2$s" target="_blank"><img src="%3$s"></a>', 
			$logo_url, 
			wpsp_get_esc_title(), 
			$image['url']  
		);		
	}
} ?>
