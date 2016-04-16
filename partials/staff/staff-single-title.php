<?php
/**
 * Template part for displaying staff single title.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<header id="staff-single-header" class="single-header clear">
	<h1 id="staff-single-title" class="entry-title single-post-title"><?php the_title(); ?></h1>
	<?php get_template_part( 'partials/staff/staff-single-position' ); ?>
</header><!-- #staff-single-header -->
