<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Habitat Cambodia
 */

if ( ! function_exists( 'wpsp_limit_title_lenght' ) ) :
	function wpsp_limit_title_lenght($length, $replacer = '...') {
		 $string = the_title('','',FALSE);
		 if(strlen($string) > $length)
		 $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
		 echo $string;
	}
endif;

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

if ( ! function_exists( 'hfhcambodia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hfhcambodia_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'hfhcambodia' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'hfhcambodia' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hfhcambodia_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hfhcambodia_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'hfhcambodia' ) );
		if ( $categories_list && hfhcambodia_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'hfhcambodia' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'hfhcambodia' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hfhcambodia' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'hfhcambodia' ), esc_html__( '1 Comment', 'hfhcambodia' ), esc_html__( '% Comments', 'hfhcambodia' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'hfhcambodia' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hfhcambodia_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hfhcambodia_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hfhcambodia_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hfhcambodia_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hfhcambodia_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hfhcambodia_categorized_blog.
 */
function hfhcambodia_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hfhcambodia_categories' );
}
add_action( 'edit_category', 'hfhcambodia_category_transient_flusher' );
add_action( 'save_post',     'hfhcambodia_category_transient_flusher' );


/**
 * Returns correct social button class
 *
 * @since 3.0.0
 */
if ( ! function_exists('wpsp_get_social_button_class') ) :
function wpsp_get_social_button_class( $style ) {

	// Set theme default style
	$style = $style ? $style : 'flat-color';
	$style = apply_filters( 'wpsp_default_social_button_style', $style );

	// None
	if ( 'none' == $style ) {
		$style = 'wpsp-social-btn-no-style';
	}

	// Minimal
	elseif ( 'minimal' == $style ) {
		$style = 'wpsp-social-btn-minimal';
	}

	// Flat
	elseif ( 'flat' == $style ) {
		$style = 'wpsp-social-btn-flat wpsp-bg-gray';
	} 

	// Flat Color
	elseif ( 'flat-color' == $style ) {
		$style = 'wpsp-social-btn-flat wpsp-social-bg';
	} 

	// Apply filters & return style
	return apply_filters( 'wpsp_get_social_button_class', 'wpsp-social-btn '. $style );
}
endif;