<?php
/**
 * Entry related posts
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Check if experts are enabled
$has_excerpt = wpsp_get_redux( 'is-blog-related-excerpt', true );

// Add Standard Classes
$classes   = array();
$classes[] = 'related-post';
$classes[] = 'col';
$classes[] = wpsp_grid_class(wpsp_get_redux('related-blog-post-columns')); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<figure class="related-post-figure clear wpsp-image-hover grow overlay-parent">
		<a href="<?php the_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" rel="bookmark" class="related-post-thumb">
			<?php wpsp_get_post_thumbnail('thumb-landscape'); ?>
			<span class="overlay-plus-hover overlay-hide theme-overlay"></span>
		</a>
	</figure>

	<?php
	// Display post excerpt
	if ( $has_excerpt ) : ?>
		<div class="related-post-content equal-height-content clear">
			<h4 class="related-post-title">
				<a href="<?php wpsp_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h4><!-- .related-post-title -->
			<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
			<div class="related-post-excerpt clr">
				<?php wpsp_excerpt( array(
					'length' => wpsp_get_redux( 'blog-related-excerpt-length', '15' ),
				) ); ?>
			</div><!-- related-post-excerpt -->
		</div><!-- .related-post-content -->
	<?php endif; ?>
	
</article><!-- #post-## -->
