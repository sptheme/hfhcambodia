<?php
/**
 * Core theme functions
 *
 * These functions are used throughout the theme and must be loaded
 * early on.
 *
 * @package Habitat Cambodia
 */

/*-------------------------------------------------------------------------------*/
/* Table of contents
/*-------------------------------------------------------------------------------*/
	# General
	# Theme options (get value)

/*-------------------------------------------------------------------------------*/
/* General
/*-------------------------------------------------------------------------------*/

/**
 * Get Theme Branding
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_get_theme_branding' ) ) :
function wpsp_get_theme_branding( $branding = true ) {
	$fullname = WPSP_THEME_BRANDING;		
	$prefix = WPSP_THEME_BRANDING_PREFIX;
	if ( $branding ) {
		return $fullname;
	} else {
		return $prefix;
	}
}
endif;

/**
 * Limit characters on the title
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'wpsp_limit_title_lenght' ) ) :
	function wpsp_limit_title_lenght($length, $replacer = '...') {
		 $string = the_title('','',FALSE);
		 if(strlen($string) > $length)
		 $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
		 echo $string;
	}
endif;


/*-------------------------------------------------------------------------------*/
/* Theme options (get value)
/*-------------------------------------------------------------------------------*/

/**
 * Returns theme options value from redux framework
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_get_redux') ) :
function wpsp_get_redux( $id, $default = '' ) {

	// Get global object
	global $redux_wpsp;

	// Return option value on customize_preview => IMPORTANT !!!
	/*if ( is_customize_preview() ) {
		return $redux_wpsp[$id];
	}*/

	// Return data from global object
	if ( ! empty( $redux_wpsp ) ) {

		// Return value
		if ( isset( $redux_wpsp[$id] ) ) {
			return $redux_wpsp[$id];
		}

		// Return default
		else {
			return $default;
		}

	}

	else {
		return $default;
	}

}
endif;

/**
 * Echo the post URL
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_permalink') ) :
function wpsp_permalink( $post_id = '' ) {
	echo wpsp_get_permalink( $post_id );
}
endif;

/**
 * Return the post URL
 *
 * @since 1.0.0
 */
function wpsp_get_permalink( $post_id = '' ) {

	// If post ID isn't defined lets get it
	$post_id = $post_id ? $post_id : get_the_ID();

	// Check wpsp_post_link custom field for custom link
	$meta = get_post_meta( $post_id, 'wpsp_post_link', true );

	// If wpsp_post_link custom field is defined return that otherwise return the permalink
	$permalink  = $meta ? $meta : get_permalink( $post_id );

	// Apply filters
	$permalink = apply_filters( 'wpsp_permalink', $permalink );

	// Sanitize & return
	return esc_url( $permalink );

}

/**
 * Echo escaped post title
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_esc_title') ) :
function wpsp_esc_title() {
	echo wpsp_get_esc_title();
}
endif;

/**
 * Return escaped post title
 *
 * @since 1.0.0
 */
function wpsp_get_esc_title() {
	return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Returns the correct classname for any specific column grid
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_grid_class') ) :
function wpsp_grid_class( $col = '4' ) {
	return esc_attr( apply_filters( 'wpsp_grid_class', 'span_1_of_'. $col ) );
}
endif;


/**
 * Get or generate excerpts
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_excerpt') ) :
function wpsp_excerpt( $args ) {
	echo wpsp_get_excerpt( $args );
}
endif;

/**
 * Get or generate excerpts
 *
 * @since 1.0.0
 */
function wpsp_get_excerpt( $args = array() ) {

	// Fallback for old method
	if ( ! is_array( $args ) ) {
		$args = array(
			'length' => $args,
		);
	}

	// Setup default arguments
	$defaults = array(
		'output'        => '',
		'length'        => '30',
		'readmore'      => false,
		'readmore_link' => '',
		'more'          => '&hellip;',
	);

	// Parse arguments
	$args = wp_parse_args( $args, $defaults );

	// Filter args
	$args = apply_filters( 'wpsp_excerpt_args', $args );

	// Extract args
	extract( $args );

	// Sanitize data
	$excerpt = intval( $length );

	// If length is empty or zero return
	if ( empty( $length ) || '0' == $length || false == $length ) {
		return;
	}

	// Get global post
	$post = get_post();

	// Display password protected notice
	if ( $post->post_password ) :

		$output = esc_html__( 'This is a password protected post.', 'learninginstitute' );
		$output = apply_filters( 'wpsp_password_protected_excerpt', $output );
		$output = '<p>'. $output .'</p>';
		return $output;

	endif;

	// Get post data
	$post_id      = $post->ID;
	$post_content = $post->post_content;
	$post_excerpt = $post->post_excerpt;

	// Get post excerpt
	if ( $post_excerpt ) {
		$post_excerpt = apply_filters( 'the_content', $post_excerpt );
	}

	// If has custom excerpt
	if ( $post_excerpt ) :

		// Display custom excerpt
		$output = $post_excerpt;

	// Create Excerpt
	else :

		// Return the content including more tag
		if ( '9999' == $length ) {
			return apply_filters( 'the_content', get_the_content( '', '&hellip;' ) );
		}

		// Return the content excluding more tag
		if ( '-1' == $length ) {
			return apply_filters( 'the_content', $post_content );
		}

		// Check for text shortcode in post
		if ( strpos( $post_content, '[vc_column_text]' ) ) {
			$pattern = '{\[vc_column_text.*?\](.*?)\[/vc_column_text\]}is';
			preg_match( $pattern, $post_content, $match );
			if ( isset( $match[1] ) ) {
				$excerpt = strip_shortcodes( $match[1] );
				$excerpt = wp_trim_words( $excerpt, $length, $more );
			} else {
				$content = strip_shortcodes( $post_content );
				$excerpt = wp_trim_words( $content, $length, $more );
			}
		}

		// No text shortcode so lets strip out shortcodes and return the content
		else {
			$content = strip_shortcodes( $post_content );
			$excerpt = wp_trim_words( $content, $length, $more );
		}

		// Add excerpt to output
		if ( $excerpt ) {
			$output .= '<p>'. $excerpt .'</p>';
		}

	endif;

	// Add readmore link to output if enabled
	if ( $readmore ) :

		$read_more_text = isset( $args['read_more_text'] ) ? $args['read_more_text'] : esc_html__( 'Read more', 'learninginstitute' );
		$output .= '<a href="'. get_permalink( $post_id ) .'" title="'.$read_more_text .'" rel="bookmark" class="wpsp-readmore theme-button">'. $read_more_text .' <span class="wpsp-readmore-rarr">&rarr;</span></a>';

	endif;

	// Apply filters for easier customization
	$output = apply_filters( 'wpsp_excerpt_output', $output );
	
	// Echo output
	return $output;

}

/**
 * Custom excerpt length for posts
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_excerpt_length') ) :
function wpsp_excerpt_length() {

	// Theme panel length setting
	$length = wpsp_get_mod( 'blog_excerpt_length', '40' );

	// Taxonomy setting
	if ( is_category() ) {
		
		// Get taxonomy meta
		$term       = get_query_var( 'cat' );
		$term_data  = get_option( "category_$term" );
		if ( ! empty( $term_data['wpsp_term_excerpt_length'] ) ) {
			$length = $term_data['wpsp_term_excerpt_length'];
		}
	}

	// Return length and add filter for quicker child theme editign
	return apply_filters( 'wpsp_excerpt_length', $length );

}
endif;

/**
 * Change default read more style
 *
 * @since 1.0.0
 */
function wpsp_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wpsp_excerpt_more', 10 );

/**
 * Change default excerpt length
 *
 * @since 1.0.0
 */
function wpsp_custom_excerpt_length( $length ) {
	return '40';
}
add_filter( 'excerpt_length', 'wpsp_custom_excerpt_length', 999 );

/**
 * Prevent Page Scroll When Clicking the More Link
 * http://codex.wordpress.org/Customizing_the_Read_More
 *
 * @since 1.0.0
 */
function wpsp_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'wpsp_remove_more_link_scroll' );

/**
 * Get Post thumbnail
 * 
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_get_post_thumbnail') ) : 
function wpsp_get_post_thumbnail($size = 'thumbnail') {
	echo wpsp_post_thumbnail( $size );
}
endif;

/**
 * Return Post thumbnail
 * 
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_post_thumbnail') ) : 
function wpsp_post_thumbnail($size = 'thumbnail') {
	global $post;
	if (has_post_thumbnail()) {
	    return get_the_post_thumbnail( $post->ID, $size ) ;
	} else { 
		return wpsp_thumbnail_placeholder($size);
	} 
}
endif; 

/**
 * Return thumbnail placeholder
 * 
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_thumbnail_placeholder') ) : 
function wpsp_thumbnail_placeholder($size = 'thumb-landscape') {
	global $redux_wpsp;
	if ( 'thumb-portrait' == $size ) {
		return '<img src="' . esc_url( $redux_wpsp['portrait-placeholder']['url']) . '">';
	} if ( 'thumb-square' == $size ) {
		return '<img src="' . esc_url( $redux_wpsp['square-placeholder']['url']) . '">';
	}else {
	    return '<img src="' . esc_url( $redux_wpsp['landscape-placeholder']['url']) . '">';
	} 
}
endif; 

/**
 * Echo post video
 *
 * @since 1.0.0
 */
function wpsp_post_video( $post_id ) {
	echo wpsp_get_post_video( $post_id );
}

/**
 * Returns post video
 *
 * @since 2.0.0
 */
if ( ! function_exists('wpsp_get_post_video') ) :
function wpsp_get_post_video( $post_id = '' ) {

	// Define video variable
	$video = '';

	// Get correct ID
	$post_id = $post_id ? $post_id : get_the_ID();

	// Embed
	if ( $meta = get_post_meta( $post_id, 'wpsp_post_video_embed', true ) ) {
		$video = $meta;
	}
	// Apply filters & return
	return apply_filters( 'wpsp_get_post_video', $video );
}
endif;

/**
 * Echo post video HTML
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_post_video_html') ) :
function wpsp_post_video_html( $video = '' ) {
	echo wpsp_get_post_video_html( $video );
}
endif;

/**
 * Returns post video HTML
 *
 * @since 1.0.0
 */
if ( ! function_exists('wpsp_get_post_video_html') ) :
function wpsp_get_post_video_html( $video = '' ) {

	// Get video
	$video = $video ? $video : wpsp_get_post_video();

	// Return if video is empty
	if ( empty( $video ) ) {
		return;
	}

	// Check post format for standard post type
	if ( 'post' == get_post_type() && 'video' != get_post_format() ) {
		return;
	}

	// Get oembed code and return
	if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
		return '<div class="responsive-video-wrap">'. $oembed .'</div>';
	}

}
endif;

if ( ! function_exists( 'wpsp_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function wpsp_paging_nav( $pages = '', $mid_size = 2 ) {
	global $wp_query, $paged;
	// Don't print empty markup if there's only one page.
	if( $pages == '' ) {

		$pages = $GLOBALS['wp_query']->max_num_pages;

		if( !$pages )
			$pages = 1;

	}
	if ( $pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $pages,
		'current'  => $paged,
		'mid_size' => $mid_size,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '← Previous', 'learninginstitute' ),
		'next_text' => __( 'Next →', 'learninginstitute' ),
        'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'learninginstitute' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

/*-------------------------------------------------------------------------------*/
/* [ Buttons ]
/*-------------------------------------------------------------------------------*/

/**
 * Returns correct social button class
 *
 * @since 1.0.0
 */
function wpsp_get_social_button_class( $style ) {

	// Set theme default style
	$style = $style ? $style : 'flat-rounded';
	$style = apply_filters( 'wpsp_default_social_button_style', $style );

	// None
	if ( 'none' == $style ) {
		$style = 'wpex-social-btn-no-style';
	}

	// Minimal
	elseif ( 'minimal' == $style ) {
		$style = 'wpex-social-btn-minimal';
	} elseif ( 'minimal-rounded' == $style ) {
		$style = 'wpex-social-btn-minimal wpex-semi-rounded';
	} elseif ( 'minimal-round' == $style ) {
		$style = 'wpex-social-btn-minimal wpex-round';
	}

	// Flat
	elseif ( 'flat' == $style ) {
		$style = 'wpex-social-btn-flat wpex-bg-gray';
	} elseif ( 'flat-rounded' == $style ) {
		$style = 'wpex-social-btn-flat wpex-semi-rounded';
	} elseif ( 'flat-round' == $style ) {
		$style = 'wpex-social-btn-flat wpex-round';
	}

	// Flat Color
	elseif ( 'flat-color' == $style ) {
		$style = 'wpex-social-btn-flat wpex-social-bg';
	} elseif ( 'flat-color-rounded' == $style ) {
		$style = 'wpex-social-btn-flat wpex-social-bg wpex-semi-rounded';
	} elseif ( 'flat-color-round' == $style ) {
		$style = 'wpex-social-btn-flat wpex-social-bg wpex-round';
	}

	// 3D
	elseif ( '3d' == $style ) {
		$style = 'wpex-social-btn-3d';
	} elseif ( '3d-color' == $style ) {
		$style = 'wpex-social-btn-3d wpex-social-bg';
	}

	// Black
	elseif ( 'black' == $style ) {
		$style = 'wpex-social-btn-black';
	} elseif ( 'black-rounded' == $style ) {
		$style = 'wpex-social-btn-black wpex-semi-rounded';
	} elseif ( 'black-round' == $style ) {
		$style = 'wpex-social-btn-black wpex-round';
	}

	// Black + Color Hover
	elseif ( 'black-ch' == $style ) {
		$style = 'wpex-social-btn-black-ch';
	} elseif ( 'black-ch-rounded' == $style ) {
		$style = 'wpex-social-btn-black-ch wpex-semi-rounded';
	} elseif ( 'black-ch-round' == $style ) {
		$style = 'wpex-social-btn-black-ch wpex-round';
	}

	// Graphical
	elseif ( 'graphical' == $style ) {
		$style = 'wpex-social-bg wpex-social-btn-graphical';
	} elseif ( 'graphical-rounded' == $style ) {
		$style = 'wpex-social-bg wpex-social-btn-graphical wpex-semi-rounded';
	} elseif ( 'graphical-round' == $style ) {
		$style = 'wpex-social-bg wpex-social-btn-graphical wpex-round';
	}

	// Apply filters & return style
	return apply_filters( 'wpsp_get_social_button_class', 'wpex-social-btn '. $style );
}

/**
 * Returns correct theme button classes based on args
 *
 * @since 3.2.0
 */
function wpsp_get_button_classes( $style = '', $color = '', $size = '', $align = '' ) {

	// Extract if style is an array of arguments
	if ( is_array( $style ) ) {
		extract( $style );
	}

	// Main classes
	if ( 'plain-text' == $style ) {
		$classes = 'theme-txt-link';
	} elseif ( $style ) {
		$classes = 'theme-button '. $style;
	} else {
		$classes = 'theme-button';
	}

	// Color
	if ( $color ) {
		$classes .= ' '. $color;
	}

	// Size
	if ( $size ) {
		$classes .= ' '. $size;
	}

	// Align
	if ( $align ) {
		$classes .= ' align-'. $align;
	}

	// Apply filters and return classes
	return apply_filters( 'wpsp_get_theme_button_classes', $classes, $style, $color, $size, $align );
}

/*-------------------------------------------------------------------------------*/
/* [ Social Share ]
/*-------------------------------------------------------------------------------*/

/**
 * Returns social sharing template part
 *
 * @since 1.0.0
 */
function wpsp_social_share_sites() {
    $sites = wpsp_get_redux( 'social-share-sites', array( 'twitter', 'facebook', 'google_plus', 'pinterest' ) );
    $sites = apply_filters( 'wpsp_social_share_sites', $sites );
    if ( $sites && ! is_array( $sites ) ) {
        $sites  = explode( ',', $sites );
    }
    return $sites;
}

/**
 * Returns correct social share position
 *
 * @since 1.0.0
 */
function wpsp_social_share_position() {
    $position = wpsp_get_redux( 'social-share-position' );
    $position = $position ? $position : 'horizontal';
    return apply_filters( 'wpsp_social_share_position', $position );
}

/**
 * Returns correct social share style
 *
 * @since 1.0.0
 */
function wpsp_social_share_style() {
    $style = wpsp_get_redux( 'social-share-style' );
    $style = $style ? $style : 'flat';
    return apply_filters( 'wpsp_social_share_style', $style );
}

/**
 * Returns the social share heading
 *
 * @since 1.0.0
 */
function wpsp_social_share_heading() {
    $heading = wpsp_get_translated_theme_mod( 'social_share_heading' );
    $heading = $heading ? $heading : esc_html__( 'Please Share This', 'hfhcambodia' );
    return apply_filters( 'wpsp_social_share_heading', $heading );
}

/*-------------------------------------------------------------------------------*/
/* [ Image ]
/*-------------------------------------------------------------------------------*/

/**
 * Outputs the img HTMl thubmails used in the Total VC modules
 *
 * @since 1.0.0
 */
function wpsp_post_thumbnail_total( $args = array() ) {
	echo wpsp_get_post_thumbnail_total( $args );
}

/**
 * Returns correct HTMl for post thumbnails
 *
 * @since 1.0.0
 */
function wpsp_get_post_thumbnail_total( $args = array() ) {

	$attr       = array();

	// Default args
	$defaults = array(
		'attachment'    => get_post_thumbnail_id(),
		'size'          => 'full',
		'width'         => '',
		'height'        => '',
		'crop'          => 'center-center',
		'alt'           => '',
		'class'         => '',
		'return'        => 'html',
		'style'         => '',
		'schema_markup' => false,
		'placeholder'   => false,
	);

	// Parse args
	$args = wp_parse_args( $args, $defaults );

	// Extract args
	extract( $args );

	// Return dummy image
	if ( '' == $attachment || $placeholder ) {
		return '<img src="'. wpsp_placeholder_img_src($size) .'" />';
	}

	// Return if there isn't any attachment
	if ( ! $attachment ) {
		return;
	}

	// Sanitize variables
	$size = ( 'wpsp-custom' == $size ) ? 'wpsp_custom' : $size;
	$size = ( 'wpsp_custom' == $size ) ? false : $size;
	$crop = ( ! $crop ) ? 'center-center' : $crop;
	$crop = ( 'true' == $crop ) ? 'center-center' : $crop;

	// Image must have an alt
	if ( empty( $alt ) ) {
		$alt = get_post_meta( $attachment, '_wp_attachment_image_alt', true );
	}
	if ( empty( $alt ) ) {
		$alt = trim( strip_tags( get_post_field( 'post_excerpt', $attachment ) ) );
	}
	if ( empty( $alt ) ) {
		$alt = trim( strip_tags( get_the_title( $attachment ) ) );
		$alt = str_replace( '_', ' ', $alt );
		$alt = str_replace( '-', ' ', $alt );
	}

	// Prettify alt attribute
	if ( $alt ) {
		$alt = ucwords( $alt );
	}

	// If image width and height equal '9999' return full image
	if ( '9999' == $width && '9999' == $height ) {
		$size  = $size ? $size : 'full';
		$width = $height = '';
	}

	// Define crop locations
	$crop_locations = array_flip( wpsp_image_crop_locations() );

	// Set crop location if defined in format 'left-top' and turn into array
	if ( $crop && in_array( $crop, $crop_locations ) ) {
		$crop = ( 'center-center' == $crop ) ? true : explode( '-', $crop );
	}

	// Get attachment URl
	$attachment_url = wp_get_attachment_url( $attachment );

	// Return if there isn't any attachment URL
	if ( ! $attachment_url ) {
		return;
	}

	// Add classes
	if ( $class ) {
		$attr['class'] = $class;
	}

	// Add alt
	if ( $alt ) {
		$attr['alt'] = esc_attr( $alt );
	}

	// Add style
	if ( $style ) {
		$attr['style'] = $style;
	}

	// Add schema markup
	if ( $schema_markup ) {
		$attr['itemprop'] = 'image';
	}

	// If on the fly image resizing is enabled or a custom width/height is defined
	if ( $width || $height ) {
		// Add Classes
		if ( $class ) {
			$class = ' class="'. $class .'"';
		}

		// If size is defined and not equal to wpex_custom
		if ( $size && 'wpsp_custom' != $size ) {
			$dims   = wpsp_get_thumbnail_sizes( $size );
			$width  = $dims['width'];
			$height = $dims['height'];
			$crop   = ! empty( $dims['crop'] ) ? $dims['crop'] : $crop;
		}

		/* Crop image with aq_resize
		 * https://github.com/syamilmj/Aqua-Resizer
		 */

		$image = aq_resize( $attachment_url, $width, $height, true );

		// Return HTMl
		if ( $image ) {

			// Return image URL
			if ( 'url' == $return ) {
				return $image;
			}

			// Return image HTMl
			else {

				// Add attributes
				$attr = array_map( 'esc_attr', $attr );
				$html = '';
				foreach ( $attr as $name => $value ) {
					$html .= ' '. esc_attr( $name ) .'="'. esc_attr( $value ) .'"';
				}

				// Return img
				return '<img src="'. esc_url( $image ) .'" width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'"'. $html .' />';

			}

		}
	}
	// Return image from add_image_size
	else {
	
		// Sanitize size
		$size = $size ? $size : 'full';

		// Return image URL
		if ( 'url' == $return ) {
			$src = wp_get_attachment_image_src( $attachment, $size, false );
			return $src[0];
		}

		// Return image HTMl
		else {
			return wp_get_attachment_image( $attachment, $size, false, $attr );
		}
	}

}

/**
 * Returns correct image hover classnames
 *
 * @since 1.0.0
 */
function wpsp_image_hover_classes( $style = '' ) {
	if ( $style ) {
		$classes   = array( 'wpsp-image-hover' );
		$classes[] = $style;
		return esc_attr( implode( ' ', $classes ) );
	}
}

/**
 * Returns thumbnail sizes
 *
 * @since 2.0.0
 */
function wpsp_get_thumbnail_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array(
		'full'  => array(
			'width'  => '9999',
			'height' => '9999',
			'crop'   => 0,
		),
	);
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width']   = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height']  = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop']    = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array( 
				'width'     => $_wp_additional_image_sizes[ $_size ]['width'],
				'height'    => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'      => $_wp_additional_image_sizes[ $_size ]['crop']
			);

		}

	}

	// Get only 1 size if found
	if ( $size ) {
		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		} else {
			return false;
		}
	}

	// Return sizes
	return $sizes;
}

/**
 * Placeholder Image
 *
 * @since 1.0.0
 */
function wpsp_placeholder_img_src( $size = 'thumb-landscape' ) {
	global $redux_wpsp;
	if ( 'thumb-portrait' == $size ) {		
		return esc_url( apply_filters( 'wpsp_placeholder_img_src', $redux_wpsp['portrait-placeholder']['url'] ) );
	} if ( 'thumb-square' == $size ) {
		return esc_url( apply_filters( 'wpsp_placeholder_img_src', $redux_wpsp['square-placeholder']['url'] ) );
	}else {
	    return esc_url( apply_filters( 'wpsp_placeholder_img_src', $redux_wpsp['landscape-placeholder']['url'] ) );
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Array ]
/*-------------------------------------------------------------------------------*/

/**
 * Returns array of WP dashicons
 *
 * @since 3.3.0
 */
function wpsp_get_dashicons_array() {
	return array(
		'admin-appearance' => 'f100',
		'admin-collapse' => 'f148',
		'admin-comments' => 'f117',
		'admin-generic' => 'f111',
		'admin-home' => 'f102',
		'admin-media' => 'f104',
		'admin-network' => 'f112',
		'admin-page' => 'f133',
		'admin-plugins' => 'f106',
		'admin-settings' => 'f108',
		'admin-site' => 'f319',
		'admin-tools' => 'f107',
		'admin-users' => 'f110',
		'align-center' => 'f134',
		'align-left' => 'f135',
		'align-none' => 'f138',
		'align-right' => 'f136',
		'analytics' => 'f183',
		'arrow-down' => 'f140',
		'arrow-down-alt' => 'f346',
		'arrow-down-alt2' => 'f347',
		'arrow-left' => 'f141',
		'arrow-left-alt' => 'f340',
		'arrow-left-alt2' => 'f341',
		'arrow-right' => 'f139',
		'arrow-right-alt' => 'f344',
		'arrow-right-alt2' => 'f345',
		'arrow-up' => 'f142',
		'arrow-up-alt' => 'f342',
		'arrow-up-alt2' => 'f343',
		'art' => 'f309',
		'awards' => 'f313',
		'backup' => 'f321',
		'book' => 'f330',
		'book-alt' => 'f331',
		'businessman' => 'f338',
		'calendar' => 'f145',
		'camera' => 'f306',
		'cart' => 'f174',
		'category' => 'f318',
		'chart-area' => 'f239',
		'chart-bar' => 'f185',
		'chart-line' => 'f238',
		'chart-pie' => 'f184',
		'clock' => 'f469',
		'cloud' => 'f176',
		'dashboard' => 'f226',
		'desktop' => 'f472',
		'dismiss' => 'f153',
		'download' => 'f316',
		'edit' => 'f464',
		'editor-aligncenter' => 'f207',
		'editor-alignleft' => 'f206',
		'editor-alignright' => 'f208',
		'editor-bold' => 'f200',
		'editor-customchar' => 'f220',
		'editor-distractionfree' => 'f211',
		'editor-help' => 'f223',
		'editor-indent' => 'f222',
		'editor-insertmore' => 'f209',
		'editor-italic' => 'f201',
		'editor-justify' => 'f214',
		'editor-kitchensink' => 'f212',
		'editor-ol' => 'f204',
		'editor-outdent' => 'f221',
		'editor-paste-text' => 'f217',
		'editor-paste-word' => 'f216',
		'editor-quote' => 'f205',
		'editor-removeformatting' => 'f218',
		'editor-rtl' => 'f320',
		'editor-spellcheck' => 'f210',
		'editor-strikethrough' => 'f224',
		'editor-textcolor' => 'f215',
		'editor-ul' => 'f203',
		'editor-underline' => 'f213',
		'editor-unlink' => 'f225',
		'editor-video' => 'f219',
		'email' => 'f465',
		'email-alt' => 'f466',
		'exerpt-view' => 'f164',
		'facebook' => 'f304',
		'facebook-alt' => 'f305',
		'feedback' => 'f175',
		'flag' => 'f227',
		'format-aside' => 'f123',
		'format-audio' => 'f127',
		'format-chat' => 'f125',
		'format-gallery' => 'f161',
		'format-image' => 'f128',
		'format-links' => 'f103',
		'format-quote' => 'f122',
		'format-standard' => 'f109',
		'format-status' => 'f130',
		'format-video' => 'f126',
		'forms' => 'f314',
		'googleplus' => 'f462',
		'groups' => 'f307',
		'hammer' => 'f308',
		'id' => 'f336',
		'id-alt' => 'f337',
		'image-crop' => 'f165',
		'image-flip-horizontal' => 'f169',
		'image-flip-vertical' => 'f168',
		'image-rotate-left' => 'f166',
		'image-rotate-right' => 'f167',
		'images-alt' => 'f232',
		'images-alt2' => 'f233',
		'info' => 'f348',
		'leftright' => 'f229',
		'lightbulb' => 'f339',
		'list-view' => 'f163',
		'location' => 'f230',
		'location-alt' => 'f231',
		'lock' => 'f160',
		'marker' => 'f159',
		'menu' => 'f333',
		'migrate' => 'f310',
		'minus' => 'f460',
		'networking' => 'f325',
		'no' => 'f158',
		'no-alt' => 'f335',
		'performance' => 'f311',
		'plus' => 'f132',
		'portfolio' => 'f322',
		'post-status' => 'f173',
		'pressthis' => 'f157',
		'products' => 'f312',
		'redo' => 'f172',
		'rss' => 'f303',
		'screenoptions' => 'f180',
		'search' => 'f179',
		'share' => 'f237',
		'share-alt' => 'f240',
		'share-alt2' => 'f242',
		'shield' => 'f332',
		'shield-alt' => 'f334',
		'slides' => 'f181',
		'smartphone' => 'f470',
		'smiley' => 'f328',
		'sort' => 'f156',
		'sos' => 'f468',
		'star-empty' => 'f154',
		'star-filled' => 'f155',
		'star-half' => 'f459',
		'tablet' => 'f471',
		'tag' => 'f323',
		'testimonial' => 'f473',
		'translation' => 'f326',
		'trash' => 'f182',
		'twitter' => 'f301',
		'undo' => 'f171',
		'update' => 'f463',
		'upload' => 'f317',
		'vault' => 'f178',
		'video-alt' => 'f234',
		'video-alt2' => 'f235',
		'video-alt3' => 'f236',
		'visibility' => 'f177',
		'welcome-add-page' => 'f133',
		'welcome-comments' => 'f117',
		'welcome-edit-page' => 'f119',
		'welcome-learn-more' => 'f118',
		'welcome-view-site' => 'f115',
		'welcome-widgets-menus' => 'f116',
		'wordpress' => 'f120',
		'wordpress-alt' => 'f324',
		'yes' => 'f147',
	);
}

/**
 * Array of image crop locations
 *
 * @link 1.0.0
 */
function wpsp_image_crop_locations() {
	return array(
		''              => esc_html__( 'Default', 'hfhcambodia' ),
		'left-top'      => esc_html__( 'Top Left', 'hfhcambodia' ),
		'right-top'     => esc_html__( 'Top Right', 'hfhcambodia' ),
		'center-top'    => esc_html__( 'Top Center', 'hfhcambodia' ),
		'left-center'   => esc_html__( 'Center Left', 'hfhcambodia' ),
		'right-center'  => esc_html__( 'Center Right', 'hfhcambodia' ),
		'center-center' => esc_html__( 'Center Center', 'hfhcambodia' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'hfhcambodia' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'hfhcambodia' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'hfhcambodia' ),
	);
}

/**
 * Image Hovers
 *
 * @since 1.0.0
 */
function wpsp_image_hovers() {
	return apply_filters( 'wpsp_image_hovers', array(
		''             => esc_html__( 'Default', 'hfhcambodia' ),
		'opacity'      => esc_html_x( 'Opacity', 'Image Hover', 'hfhcambodia' ),
		'grow'         => esc_html_x( 'Grow', 'Image Hover', 'hfhcambodia' ),
		'shrink'       => esc_html_x( 'Shrink', 'Image Hover', 'hfhcambodia' ),
		'side-pan'     => esc_html_x( 'Side Pan', 'Image Hover', 'hfhcambodia' ),
		'vertical-pan' => esc_html_x( 'Vertical Pan', 'Image Hover', 'hfhcambodia' ),
		'tilt'         => esc_html_x( 'Tilt', 'Image Hover', 'hfhcambodia' ),
		'blurr'        => esc_html_x( 'Normal - Blurr', 'Image Hover', 'hfhcambodia' ),
		'blurr-invert' => esc_html_x( 'Blurr - Normal', 'Image Hover', 'hfhcambodia' ),
		'sepia'        => esc_html_x( 'Sepia', 'Image Hover', 'hfhcambodia' ),
		'fade-out'     => esc_html_x( 'Fade Out', 'Image Hover', 'hfhcambodia' ),
		'fade-in'      => esc_html_x( 'Fade In', 'Image Hover', 'hfhcambodia' ),
	) );
}