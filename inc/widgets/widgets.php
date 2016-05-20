<?php
/**
 * Include all custom widgets
 *
 * @package Habitat Cambodia
 */


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpsp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar', 'wpsp_widget' ),
		'id'            => 'home-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Home Sidebar 2', 'wpsp_widget' ),
		'id'            => 'home-sidebar-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Sidebar', 'wpsp_widget' ),
		'id'            => 'header-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wpsp_widget' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'wpsp_widget' ),
		'id'            => 'page-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Contact Sidebar', 'wpsp_widget' ),
		'id'            => 'contact-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom Sidebar', 'wpsp_widget' ),
		'id'            => 'footer-bottom-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wpsp_widgets_init' );

/**
 * Add shortcode support to text widget
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Register custom sidebars with Redux
 * 
 */
function wpsp_custom_sidebars() {
	global $redux_wpsp;
	
	if ( !empty($redux_wpsp['sidebar-area']) ) {
		$sidebars = $redux_wpsp['sidebar-area'];
		foreach( $sidebars as $sidebar ) {
			if ( !empty($sidebar) ) {
				register_sidebar(
					array(	
						'name' => $sidebar,
						'id' => strtolower(str_replace(' ', '-', $sidebar)),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<h2 class="widget-title">',
						'after_title' => '</h2>'
					)
				);
			}
		}
	}
}
add_action( 'widgets_init', 'wpsp_custom_sidebars' );

/**
 * Sidebar choice - work with option tree
 * 
 */
if ( ! function_exists( 'wpsp_sidebar_primary' ) ) :	
function wpsp_sidebar_primary() {
	global $redux_wpsp;
	$sidebar = 'sidebar';

	// Set sidebar based on page
	if ( is_home() && $redux_wpsp['sidebar-home'] ) $sidebar = $redux_wpsp['sidebar-home'];
	if ( is_single() && $redux_wpsp['sidebar-single'] ) $sidebar = $redux_wpsp['sidebar-single'];
	//if ( is_singular('portfolio') && $redux_wpsp['sidebar-single-portfolio'] ) $sidebar = $redux_wpsp['sidebar-single-portfolio'];
	if ( is_singular('staff') && $redux_wpsp['staff-custom-sidebar'] ) $sidebar = $redux_wpsp['staff-custom-sidebar'];
	if ( is_archive() && $redux_wpsp['sidebar-archive'] ) $sidebar = $redux_wpsp['sidebar-archive'];
	if ( is_category() && $redux_wpsp['sidebar-archive-category'] ) $sidebar = $redux_wpsp['sidebar-archive-category'];
	// if ( is_tax('portfolio_category') && $redux_wpsp['sidebar-archive-portfolio'] ) $sidebar = $redux_wpsp['sidebar-archive-portfolio'];
	// if ( is_tax('portfolio_province') && $redux_wpsp['sidebar-archive-portfolio'] ) $sidebar = $redux_wpsp['sidebar-archive-portfolio'];
	// if ( is_tax('portfolio_tag') && $redux_wpsp['sidebar-archive-portfolio'] ) $sidebar = $redux_wpsp['sidebar-archive-portfolio'];
	if ( is_tax('publications_tag') && $redux_wpsp['publications-archive-custom-sidebar'] ) $sidebar = $redux_wpsp['publications-archive-custom-sidebar'];
	if ( is_tax('publications_category') && $redux_wpsp['publications-archive-custom-sidebar'] ) $sidebar = $redux_wpsp['publications-archive-custom-sidebar'];
	if ( is_search() && $redux_wpsp['sidebar-search'] ) $sidebar = $redux_wpsp['sidebar-search'];
	if ( is_404() && $redux_wpsp['sidebar-404'] ) $sidebar = $redux_wpsp['sidebar-404'];
	if ( is_page() && $redux_wpsp['sidebar-page'] ) $sidebar = $redux_wpsp['sidebar-page'];
	//if ( is_page_template( 'templates/page-team.php' ) ) $sidebar = $redux_wpsp['sidebar-page-team'];
	

	// Check for page/post specific sidebar
	if ( is_page() || is_single() ) {
		// Reset post data
		wp_reset_postdata();
		global $post;
		// Get meta
		$meta = get_post_meta($post->ID,'wpsp_sidebar_primary',true);
		if ( $meta ) { $sidebar = $meta; }
	}

	// Return sidebar
	return $sidebar;
}
endif;

/**
 * Layout choice
 * 
 */
if ( ! function_exists( 'wpsp_layout_class' ) ) :
function wpsp_layout_class() {
	global $redux_wpsp;
	// Default layout
	$layout = 'col-2cr';
	$default = 'col-2cr';

	// Check for page/post specific layout
	if ( is_page() || is_single() ) {
		// Reset post data
		wp_reset_postdata();
		global $post;
		// Get meta
		$meta = get_post_meta($post->ID,'wpsp_layout',true);
		
		// Get if set and not set to inherit
		if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) { $layout = $meta; }
		
		// Else check for page-global / single-global
		elseif ( is_single() && ( $redux_wpsp['layout-single'] !='inherit' ) ) $layout = $redux_wpsp['layout-single'];
		elseif ( is_page() && ( $redux_wpsp['layout-page'] !='inherit' ) ) $layout = $redux_wpsp['layout-page'];
		
		// Else check for custom post
		//elseif ( is_singular('portfolio') && ( $redux_wpsp['layout-single-portfolio'] !='inherit' ) ) $layout = $redux_wpsp['layout-single-portfolio'];
		elseif ( is_singular('staff') && ( $redux_wpsp['staff-single-layout'] !='inherit' ) ) $layout = $redux_wpsp['staff-single-layout'];

		// Else check for custom template
		/*elseif ( is_page_template( 'templates/page-team.php' ) && ( $redux_wpsp['layout-team'] !='inherit' ) ) $layout = $redux_wpsp['layout-team'];*/
			
		// Else get global option
		else $layout = $redux_wpsp['layout-global'];
	}
	
	// Set layout based on page
	elseif ( is_home() && ( $redux_wpsp['layout-home'] !='inherit' ) ) $layout = $redux_wpsp['layout-home'];
	elseif ( is_category() && ( $redux_wpsp['layout-archive-category'] !='inherit' ) ) $layout = $redux_wpsp['layout-archive-category'];
	elseif ( is_archive() && ( $redux_wpsp['layout-archive'] !='inherit' ) ) $layout = $redux_wpsp['layout-archive'];
	// elseif ( is_tax('portfolio_category') && ( $redux_wpsp['layout-archive-portfolio'] !='inherit' ) ) $layout = $redux_wpsp['layout-archive-portfolio'];
	// elseif ( is_tax('portfolio_province') && ( $redux_wpsp['layout-archive-portfolio'] !='inherit' ) ) $layout = $redux_wpsp['layout-archive-portfolio'];
	// elseif ( is_tax('portfolio_tag') && ( $redux_wpsp['layout-archive-portfolio'] !='inherit' ) ) $layout = $redux_wpsp['layout-archive-portfolio'];
	elseif ( is_tax('publications_tag') && ( $redux_wpsp['publications-archive-layout'] !='inherit' ) ) $layout = $redux_wpsp['publications-archive-layout'];
	elseif ( is_tax('publications_category') && ( $redux_wpsp['publications-archive-layout'] !='inherit' ) ) $layout = $redux_wpsp['publications-archive-layout'];
	elseif ( is_search() && ( $redux_wpsp['layout-search'] !='inherit' ) ) $layout = $redux_wpsp['layout-search'];
	elseif ( is_404() && ( $redux_wpsp['layout-404'] !='inherit' ) ) $layout = $redux_wpsp['layout-404'];
	
	// Global option
	else $layout = $redux_wpsp['layout-global'];
	
	// Return layout class
	return $layout;
}
endif;

/**
 * Add layout option in body class
 * 
 */
if ( ! function_exists( 'wpsp_layout_option_body_class' ) ) :
function wpsp_layout_option_body_class( $classes ) {
	$classes[] = wpsp_layout_class();
	return $classes;
}
add_filter( 'body_class', 'wpsp_layout_option_body_class' );	
endif;

/**
 * Include all custom widgets
 *
 * @since   1.0.0
 */
function wpsp_custom_widgets() {

    // Define array of custom widgets for the theme
    $widgets = array(
        'quick-contact',
        'facebook-page',
        'call-to-action',
        'social-fontawesome',
        'custom-taxonomy-menu',
        //'modern-menu',
        'video',
        'posts-thumbnails',
        'about',
        'events',
    );

    // Loop through widgets and load their files
    foreach ( $widgets as $widget ) {
        $widget_file = get_template_directory() .'/inc/widgets/'. $widget .'-widget.php';
        if ( file_exists( $widget_file ) ) {
            load_template( $widget_file );
        }
    }
}
add_action( 'after_setup_theme', 'wpsp_custom_widgets', 5 );