<?php
/**
 * Title Push Up Overlay
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

<div class="overlay-title-bottom theme-overlay textcenter">
	<span class="title"><?php the_title(); ?></span>
</div><!-- .overlay-title-bottom -->