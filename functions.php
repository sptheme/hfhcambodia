<?php
/**
 * Habitat Cambodia functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Habitat Cambodia
 */

// Theme branding
define( 'WPSP_THEME_BRANDING', 'HFH Cambodia' );
define( 'WPSP_THEME_BRANDING_PREFIX', 'HFHC' );

if ( ! function_exists( 'hfhcambodia_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hfhcambodia_setup() {

	// This theme styles the visual editor to resemble the theme style.
	$font_url = 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic';
	add_editor_style( array( 'css/editor-style.css', str_replace( ',', '%2C', $font_url ) ) );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Habitat Cambodia, use a find and replace
	 * to change 'hfhcambodia' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hfhcambodia', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'thumb-full', 960, 625, true );
	add_image_size('thumb-landscape', 750, 488, true);
	add_image_size( 'thumb-portrait', 360, 518, true );
	add_image_size('thumb-square', 360, 360, true);
	

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'hfhcambodia' ),
		'mobile' => esc_html__( 'Mobile Menu', 'hfhcambodia' ),
		'footer' => esc_html__( 'Footer Menu', 'hfhcambodia' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		//'aside',
		//'image',
		'video',
		'gallery',
		//'quote',
		//'link',
	) );
}
endif; // hfhcambodia_setup
add_action( 'after_setup_theme', 'hfhcambodia_setup' );

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function wpsp_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'wpsp_add_excerpt_support_for_pages' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hfhcambodia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hfhcambodia_content_width', 620 );
}
add_action( 'after_setup_theme', 'hfhcambodia_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function hfhcambodia_scripts() {
	wp_enqueue_style( 'hfhcambodia-style', get_stylesheet_uri() );

	//Add Google Fonts (English): Merriweather and Open Sans
	//wp_enqueue_style( 'google-font-english', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' );
	//wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' );

	//Add Google Font (Khmer): Hanuman
	//wp_enqueue_style( 'google-font-khmer', 'https://fonts.googleapis.com/css?family=Hanuman:400,700' );

	//Enabling Local Web Fonts
	wp_enqueue_style( 'local-fonts-english', get_template_directory_uri() . '/fonts/custom-fonts.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );

	wp_enqueue_style( 'mobile-menu', get_template_directory_uri() . '/css/mobile-menu.css' );
	wp_enqueue_style( 'superslides', get_template_directory_uri() . '/css/superslides.css' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );

	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20160218', true );
	wp_enqueue_script( 'jquery-fitvideo', get_template_directory_uri() . '/js/vendor/jquery.fitvids.js', array(), '20160218', true );
	wp_enqueue_script( 'jquery-superslides', get_template_directory_uri() . '/js/vendor/jquery.superslides.min.js', array(), '20160218', true );
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/vendor/jquery.magnific-popup.min.js', array(), '20160218', true );
	wp_enqueue_script( 'jquery-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20160218', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hfhcambodia_scripts' );

/**
 * Enqueue Custom Admin Styles and Scripts
 */
function wpsp_admin_scripts_styles( $hook ) {
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );
	if ( !in_array($hook, array('post.php','post-new.php')) )
		return;
	wp_enqueue_script('post-formats', get_template_directory_uri() . '/js/admin-scripts.js', array( 'jquery' ));
}
add_action('admin_enqueue_scripts', 'wpsp_admin_scripts_styles');

/**
 * Print customs css
 */
function wpsp_print_ie_script(){
	echo '<!--[if lt IE 9]>'. "\n";
	echo '<script src="' . esc_url( get_template_directory_uri() . '/js/vendor/html5.js' ) . '"></script>'. "\n";
	echo '<![endif]-->'. "\n";
}
add_action('wp_head', 'wpsp_print_ie_script');

/**
 * Core functions
 */
require get_template_directory() . '/inc/core-functions.php';

/**
 * Add Redux Framework
 */
require get_template_directory() . '/inc/admin/admin-init.php';

/**
 * Register sidebar and widget area.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/*
 * Add Meta Box
 * https://metabox.io/
 */
require get_template_directory() . '/inc/meta-box/meta-box.php';
require get_template_directory() . '/inc/meta-box/meta-config.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/aq_resizer.php';
/**
 * Sanitize inputted data.
 */
require get_template_directory() . '/inc/sanitize-data.php';

/**
 * Custom hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Blog helper functions
 */
require get_template_directory() . '/inc/blog-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
