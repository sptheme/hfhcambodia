<?php
/**
 * Shortcodes functions
 *
 * @package Learning_Institute
 */

/**
 * Print script and style of shortcodes
 */
//add_action( 'wp_enqueue_scripts', 'add_script_style_sc' );

function add_script_style_sc() {
	global $post;
	if( !is_admin() ){
		wp_enqueue_script( 'shortcode-js', SC_JS_URL . 'shortcodes.js', array(), SC_VER, true );
		wp_enqueue_style( 'shortcode', SC_CSS_URL . 'shortcodes.css', false, SC_VER );
	}
	
}

/**
 * Register and initialize short codes
 */
function wpsp_add_shortcodes() {
	add_shortcode( 'col', 'col' );
	//add_shortcode( 'button', 'wpsp_button_shortcode' );
	add_shortcode( 'sc_staff', 'wpsp_staff_shortcode' );
	add_shortcode( 'sc_partner', 'wpsp_partner_shortcode' );
	add_shortcode( 'sc_publication', 'wpsp_publication_shortcode' );
	add_shortcode( 'sc_post', 'wpsp_post_shortcode' );
	
}
add_action( 'init', 'wpsp_add_shortcodes' );

/**
 * Fix Shortcodes 
 */
if( !function_exists('wpsp_fix_shortcodes') ) {
	function wpsp_fix_shortcodes($content){
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
}
add_filter('the_content', 'wpsp_fix_shortcodes');

/**
 * Helper function for removing automatic p and br tags from nested short codes
 */
function return_clean( $content, $p_tag = false, $br_tag = false )
{
	$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

	if ( $br_tag )
		$content = preg_replace( '#<br \/>#', '', $content );

	if ( $p_tag )
		$content = preg_replace( '#<p>|</p>#', '', $content );

	return do_shortcode( shortcode_unautop( trim( $content ) ) );
}

if ( ! function_exists( 'col' ) ) :
/**
 * Column
 */
function col( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'full'
	), $atts ) );
	$out = '<div class="' . $type . '">' . return_clean($content) . '</div>';
	if ( strpos( $type, 'last' ) )
		$out .= '<div class="clear"></div>';
	return $out;
}
endif;

if ( ! function_exists( 'wpsp_button_shortcode' ) ) :
/**
 * Button
 */
function wpsp_button_shortcode($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'url' => 'null',
	), $atts));
	
	return '<a class="button" href="' . $url .'">' . $content . '</a>';
	
}
endif;

if ( ! function_exists( 'wpsp_accordion_shortcode' ) ) :
/**
 * Accordion
 * Main accordion container
 */
function wpsp_accordion_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => 'one',
		'size' => 'small',		
		'open_index' => 0
	), $atts));

	return '<div class="accordion ' . $size . ' ' . $style . ' clearfix" data-opened="' . $open_index . '">' . return_clean($content) . '</div>';
}
endif;

if ( ! function_exists( 'wpsp_accordion_section_shortcode' ) ) :
/**
 * Accordion section
 */
function wpsp_accordion_section_shortcode($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' => 'Title Goes Here',		
	), $atts));

	return '<section><h4>' . $title . '</h4><div><p>' . return_clean($content) . '</p></div></section>';
	
}
endif;

if ( ! function_exists( 'wpsp_staff_shortcode' ) ) :
/**
 * staff shortcode
 *
 * Options: Show all staff / by Category
 *
 */
function wpsp_staff_shortcode( $atts, $content = null ){
	ob_start();
	extract( shortcode_atts( array(
		'term_id' => null,
		'post_count' => null,
		'post_style' => null,
		'cols' => null
	), $atts ) );

	$args = array();
	if ( $term_id != '-1' ) {
		$args = array(
			'tax_query' => array(
					array(
						'taxonomy' => 'staff_category',
						'field'    => 'id',
						'terms'    => array($term_id)
					)
				),
			);
	}

	$defaults = array(
			'post_type' => 'staff',
			'posts_per_page' => $post_count
		);
	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	$staff_query = new WP_Query($args);

	if ( $staff_query->have_posts() ) { ?>
		<div class="wpsp-row clearfix">

	<?php while ( $staff_query->have_posts() ) : $staff_query->the_post(); ?>
	<?php
		$entry_classes = array( 'staff-entry' );
		$entry_classes[] = $post_style;
		$entry_classes[] = 'col';
		$entry_classes[] = wpsp_grid_class($cols); 
	?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
				<div class="staff-entry-inner">
				<?php get_template_part( 'partials/staff/staff-entry-media' ); ?>
				<?php get_template_part( 'partials/staff/staff-entry-content' ); ?>
				</div> <!-- .inner-staff-entry -->
			</article><!-- #post-## -->
	<?php endwhile; wp_reset_postdata(); ?>

		</div> <!-- .wpsp-row .clearfix -->
	<?php	
	} else {
		echo esc_html__( 'Sorry, new content will coming soon.', 'hfhcambodia' );
	}

	return ob_get_clean();
}
endif;

if ( ! function_exists( 'wpsp_partner_shortcode' ) ) :
/**
 * partner shortcode
 *
 * Options: Show all partner / by Category
 *
 */
function wpsp_partner_shortcode( $atts, $content = null ){
	ob_start();
	extract( shortcode_atts( array(
		'term_id' => null,
		'post_count' => null,
		'cols' => null
	), $atts ) );

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array();
	if ( $term_id != '-1' ) {
		$args = array(
			'tax_query' => array(
					array(
						'taxonomy' => 'partner_category',
						'field'    => 'id',
						'terms'    => array($term_id)
					)
				),
			);
	}

	$defaults = array(
			'post_type' => 'partner',
			'posts_per_page' => $post_count,
			'paged' 		=> $paged
		);
	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	$partner_query = new WP_Query($args);

	if ( $partner_query->have_posts() ) { ?>
		<div class="wpsp-row clearfix">

	<?php while ( $partner_query->have_posts() ) : $partner_query->the_post(); ?>
	<?php
		$entry_classes = array( 'entry-partner' );
		$entry_classes[] = 'col';
		$entry_classes[] = wpsp_grid_class($cols);
	?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
				<?php get_template_part( 'partials/partner/partner-entry-media' ); ?>
			</article><!-- #post-## -->
	<?php endwhile; wp_reset_postdata(); ?>

		</div> <!-- .wpsp-row .clearfix -->
		<?php // Pagination
            if(function_exists('wp_pagenavi'))
                wp_pagenavi();
            else 
                wpsp_paging_nav($partner_query->max_num_pages);  ?>
	<?php	
	} else {
		echo esc_html__( 'Sorry, new content will coming soon.', 'hfhcambodia' );
	}

	return ob_get_clean();
}
endif;

if ( ! function_exists( 'wpsp_publication_shortcode' ) ) :
/**
 * publication shortcode
 *
 * Options: Show all publication / by Category
 *
 */
function wpsp_publication_shortcode( $atts, $content = null ){
	ob_start();
	extract( shortcode_atts( array(
		'term_id' => null,
		'post_count' => null,
		'cols' => null
	), $atts ) );

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array();
	if ( $term_id != '-1' ) {
		$args = array(
			'tax_query' => array(
					array(
						'taxonomy' => 'publications_category',
						'field'    => 'id',
						'terms'    => array($term_id)
					)
				),
			);
	}

	$defaults = array(
			'post_type' => 'publications',
			'posts_per_page' => $post_count,
			'paged' 		=> $paged
		);
	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	$publication_query = new WP_Query($args);

	if ( $publication_query->have_posts() ) { ?>
		<div class="wpsp-row clearfix">

	<?php while ( $publication_query->have_posts() ) : $publication_query->the_post(); ?>
	<?php
		$entry_classes = array( 'entry-publication-article' );
		$entry_classes[] = 'col';
		$entry_classes[] = wpsp_grid_class($cols); 
	?>	
			<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
				<?php get_template_part( 'template-parts/publication/publication-entry-media' ); ?>
				<?php get_template_part( 'template-parts/publication/publication-entry-title' ); ?>	
				<?php get_template_part( 'template-parts/publication/publication-entry-meta' ); ?>
			</article><!-- #post-## -->
	<?php endwhile; wp_reset_postdata(); ?>

		</div> <!-- .wpsp-row .clearfix -->
		<?php // Pagination
            if(function_exists('wp_pagenavi'))
                wp_pagenavi();
            else 
                wpsp_paging_nav($publication_query->max_num_pages);  ?>
	<?php	
	} else {
		echo esc_html__( 'Sorry, new content will coming soon.', 'hfhcambodia' );
	}

	return ob_get_clean();
}
endif;

if ( ! function_exists( 'wpsp_post_shortcode' ) ) :
/**
 * post shortcode
 *
 * Options: Show all post / by Category
 *
 */
function wpsp_post_shortcode( $atts, $content = null ){
	ob_start();
	extract( shortcode_atts( array(
		'term_id' => null,
		'post_format' => null,
		'post_meta' => null,
		'post_excerpt' => null,
		'post_style' => null,
		'post_offset' => null,
		'post_count' => null,
		'cols' => null
	), $atts ) );

	//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array();
	if ( $post_format == '' ) {
		$args = array(
			'tax_query' => array(
					array(
			            'taxonomy' => 'post_format',
			            'field' => 'slug',
			            'terms' => array('post-format-quote','post-format-audio','post-format-image','post-format-link'),
			            'operator' => 'NOT IN'
			          )
				),
			);
	}

	if ( $post_format != 'post-format-standard' && $post_format != '' ) {
		$args = array(
			'tax_query' => array(
					array(
			            'taxonomy' => 'post_format',
			            'field' => 'slug',
			            'terms' => array($post_format),
			            'operator' => 'IN'
			          )
				),
			);
	}
	if ( $post_offset != '' ) {
		$args = array(
				'offset' => $post_offset
			);
	}
	$defaults = array(
			'post_type' => 'post',
			'category__in' => $term_id,
			'posts_per_page' => $post_count,
			//'paged' 		=> $paged,
			'tax_query' => array( 
					array(
			            'taxonomy' => 'post_format',
			            'field' => 'slug',
			            'terms' => array('post-format-quote','post-format-audio','post-format-gallery','post-format-image','post-format-link','post-format-video'),
			            'operator' => 'NOT IN'
			           ) 
				)
		);
	$args = wp_parse_args( $args, $defaults );
	extract( $args );

	$post_query = new WP_Query($args);

	if ( $post_query->have_posts() ) { ?>
		<div class="wpsp-row clearfix">
		<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
		<?php // entry-class
		$entry_classes = array( 'blog-entry' );
		$entry_classes[] = 'blog-entry-shortcode';
		$entry_classes[] = $post_style;
		$entry_classes[] = 'col';
		$entry_classes[] = wpsp_grid_class($cols); ?>	
				<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
					<div class="blog-entry-inner">
					<?php get_template_part( 'partials/blog/media/blog-entry' ); ?>
					<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>
					<?php if ( $post_meta )  get_template_part( 'partials/blog/blog-entry-meta' ); ?>
					<?php if ( $post_excerpt )  get_template_part( 'partials/blog/blog-entry-content' ); ?>
					</div>
				</article><!-- #post-## -->
		<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php // Pagination
            if(function_exists('wp_pagenavi'))
                wp_pagenavi();
            else 
                wpsp_paging_nav($post_query->max_num_pages);  ?>
	<?php	
	} else {
		echo esc_html__( 'Sorry, new content will coming soon.', 'hfhcambodia' );
	}
	return ob_get_clean();
}
endif;