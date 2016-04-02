<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
			// Single Page
			if ( is_singular( 'page' ) ) {

				get_template_part( 'partials/page-single-layout' );

			}

			// Single posts
			elseif ( is_singular( 'post' ) ) {

				get_template_part( 'partials/blog/blog-single-layout' );

			}?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
