<?php
/**
 * Template part for displaying Event entry title
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<h2 class="event-entry-title entry-title">
	<a href="<?php wpsp_permalink(); ?>" title="<?php wpsp_esc_title(); ?>"><?php the_title(); ?></a>
</h2><!-- .event-entry-title -->