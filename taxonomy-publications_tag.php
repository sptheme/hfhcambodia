<?php
/**
 * The template for displaying pulication category taxonomy.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Learning_Institute
 */

get_header(); ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		if ( have_posts() ) : ?>

			<header class="entry-header">
				<?php 
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' ); 
				?>
			</header><!-- .entry-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'partials/publication/publication-entry-layout' );

			endwhile;

			 // Pagination
            if(function_exists('wp_pagenavi'))
                wp_pagenavi();
            else 
                wpsp_paging_nav();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
