<?php
/**
 * Template part for displaying single post title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<header id="blog-single-header" class="blog-single-header">
	<h1 id="blog-single-title" class="blog-single-title"><?php the_title(); ?></h1>
</header><!-- .entry-header -->
