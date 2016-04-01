<?php
/**
 * Single blog meta
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get meta sections
$sections = wpsp_blog_single_meta_sections();

// Return if sections are empty
if ( empty( $sections ) ) {
	return;
}

// Add class for meta with title
$classes = 'meta clear'; global $redux_wpsp; ?>

<ul class="<?php echo esc_attr( $classes ); ?>">
	<?php
	// Loop through meta sections
	foreach ( $sections as $key => $value ) : ?>

		<?php if ( $key == 'date' && $value == '1' ) : ?>
			<li class="meta-date"><span class="fa fa-clock-o"></span><time class="published updated" datetime="<?php the_date('Y-m-d');?>"><?php echo get_the_date(); ?></time></li>
		<?php endif; ?>

		<?php if ( $key == 'author' && $value == '1' ) : ?>
			<li class="meta-author"><span class="fa fa-user"></span><span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span></li>
		<?php endif; ?>

		<?php if ( $key == 'categories' && $value == '1' ) : ?>
			<li class="meta-category"><span class="fa fa-folder-o"></span><?php the_category( ', ', get_the_ID() ); ?></li>
		<?php endif; ?>

		<?php if ( $key == 'comments' && $value == '1' && comments_open() && ! post_password_required() ): ?>
			<li class="meta-comments comment-scroll"><span class="fa fa-comment-o"></span><?php comments_popup_link( esc_html__( '0 Comments', 'total' ), esc_html__( '1 Comment',  'total' ), esc_html__( '% Comments', 'total' ), 'comments-link' ); ?></li>
		<?php endif; ?>

	<?php endforeach; ?>

</ul><!-- .meta -->