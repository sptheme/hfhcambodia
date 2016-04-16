<?php
/**
 * Template part for displaying staff single share.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Get post id
$post_id = get_the_ID();

// Posts count
$posts_count = wpsp_get_redux( 'staff-related-count', '3' );

// Return if count is empty or 0
if ( ! $posts_count || '0' == $posts_count ) {
	return;
}

// Related query arguments
$args = array(
	'post_type'      => 'staff',
	'posts_per_page' => $posts_count,
	'orderby'        => 'rand',
	'post__not_in'   => array( $post_id ),
	'no_found_rows'  => true,
);

// Query by terms
$cats     = wp_get_post_terms( $post_id, 'staff_category' ); 
$cats_ids = array();  
foreach( $cats as $related_cat ) {
	$cats_ids[] = $related_cat->term_id; 
}
if ( ! empty( $cats_ids ) ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'staff_category',
			'field'    => 'id',
			'terms'    => $cats_ids,
			'operator' => 'IN',
		),
	);
}

// Apply filters to query args
$args = apply_filters( 'wpsp_related_staff_args', $args );

// Run Query - must be set to $related_query var!!
$related_query = new wp_query( $args );

// If posts were found display related items
if ( $related_query->have_posts() ) :

	// Wrap classes
	$wrap_classes = 'related-staff-posts clear'; ?>

	<section id="staff-single-related" class="<?php echo esc_attr( $wrap_classes ); ?>">

		<?php
		// Get and translate heading text
		$heading = wpsp_get_translated_theme_mod( 'staff_related_title' );
		$heading = $heading ? $heading : esc_html__( 'Related Staff', 'hfhcambodia' );

		// If Heading text isn't empty
		if ( $heading ) {
			printf('<div class="theme-heading related-posts-title"><span class="text">%s</span></div>', $heading);
		} ?>

		<div class="wpsp-row clear">

			<?php
			// Define post counter
			$wpsp_count = '0';

			// Loop through posts
			foreach( $related_query->posts as $post ) : setup_postdata( $post );

				// Add to counter
				$wpsp_count++;

				// Include template (use include to pass variables)
				if ( $template = locate_template( 'partials/staff/staff-entry.php' ) ) {
					include( $template );
				}

				// Reset counter
				if ( $wpsp_count == wpsp_get_redux( 'staff-related-columns', '3' ) ) {
					$wpsp_count = '0';
				}

			// End loop
			endforeach; ?>

		</div><!-- .wpex-row -->

	</section><!-- .related-staff-posts -->

<?php
// End have_posts check
endif; ?>

<?php
// Reset the global $post data to prevent conflicts
wp_reset_postdata(); ?>
