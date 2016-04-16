<?php
/**
 * Magnifying Hover Overlay
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
} ?>

<div class="magnifying-hover overlay-hide theme-overlay"><span class="fa fa-search"></span></div>