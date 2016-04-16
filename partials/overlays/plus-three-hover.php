<?php
/**
 * Plus Three Hover Overlay
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

<div class="overlay-plus-three-hover overlay-hide theme-overlay wpsp-accent-color"><span class="fa fa-plus-circle"></span></div>