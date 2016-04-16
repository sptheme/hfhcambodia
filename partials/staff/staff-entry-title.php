<?php
/**
 * Template part for displaying Staff entry title
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<h2 class="staff-entry-title entry-title">
	<?php
	// Display staff title with links
	if ( wpsp_get_redux( 'is-staff-links', true ) ) : ?>
		<a href="<?php wpsp_permalink(); ?>" title="<?php wpsp_esc_title(); ?>"><?php the_title(); ?></a>
	<?php
	// Display simple title without links
	else : ?>
		<?php the_title(); ?>
	<?php endif; ?>
</h2><!-- .staff-entry-title -->