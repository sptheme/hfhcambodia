<?php
/**
 * Title Category Visible Overlay
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
}

// Get category taxonomy for current post type
$taxonomy = wpsp_get_post_type_cat_tax();

// Get terms
if ( $taxonomy ) {
	$terms = wpsp_list_post_terms( $taxonomy, $show_links = false, $echo = false );
} ?>

<div class="overlay-title-category-visible theme-overlay">
	<div class="overlay-title-category-visible-inner clear">
		<div class="overlay-title-category-visible-text clear">
			<div class="overlay-title-category-visible-title">
				<?php the_title(); ?>
			</div><!-- .overlay-title-category-visible-title -->
			<?php if ( ! empty( $terms ) ) : ?>
				<div class="overlay-title-category-visible-category">
					<?php echo $terms; ?>
				</div><!-- .overlay-title-category-visible-category -->
			<?php endif; ?>
		</div><!-- .overlay-title-category-visible-text -->
	</div><!-- .overlay-title-category-visible-inner -->
</div><!-- .overlay-title-category-visible -->