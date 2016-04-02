<?php
/**
 * Single related posts
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Return if disabled
if ( ! wpsp_get_redux('is-related-blog-post') ) {
	return;
}

// Posts count
$posts_count = wpsp_get_redux('related-blog-post-count');

// Return if count is empty or 0 - easy for child theme
if ( ! $posts_count || '0' == $posts_count ) {
	return;
}

// Query by terms
$cats     = wp_get_post_terms( get_the_ID(), 'category' );
$cats_ids = array();  
foreach( $cats as $wpsp_related_cat ) {
	$cats_ids[] = $wpsp_related_cat->term_id; 
} 

// Query args
$args = array(
	'posts_per_page' => $posts_count,
	'orderby'        => 'rand',
	'category__in'   => $cats_ids,
	'post__not_in'   => array( get_the_ID() ),
	'no_found_rows'  => true,
	'tax_query'      => array (
		'relation'  => 'AND',
		array (
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio', 'post-format-image', 'post-format-aside', 'post-format-chat', 'post-format-status' ),
			'operator' => 'NOT IN',
		),
	),
);
$args = apply_filters( 'wpsp_related_blog_post_args', $args );

// Run Query - must be set to $wpex_related_query var!!
$related_query = new wp_query( $args );

// If posts were found display related items
if ( $related_query->have_posts() ) : ?>
	<section id="related-blog-posts">
		<?php
		$heading = wpsp_get_redux('related-post-title');
		$heading = $heading ? $heading : esc_html__( 'You may also see...', 'hfhcambodia' );
		if ( $heading ) {
			printf('<h3>%s</h3>', $heading);
		} ?>
		<div class="wpsp-row clear">
			<?php 
			// Loop through posts
			foreach( $related_query->posts as $post ) : setup_postdata( $post );
				// Include template (use include to pass variables)
				include( locate_template( 'partials/blog/blog-entry-related.php' ) );
			endforeach;	?>
		</div> <!-- .wpsp-row .clearfix -->	
	</section>
<?php endif; ?>
