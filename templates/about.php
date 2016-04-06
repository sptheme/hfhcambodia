<?php
/**
 * Template Name: About
 *
 * This is the template that displays custom about page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

get_header(); 

	$about_meta = get_post_meta( $post->ID );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="welcome-message wpsp-row no-margin-grid clear">
				<div class="col span_1_of_2 photo-profile">
					<?php $photo_profile = wp_get_attachment_url( rwmb_meta('wpsp_profile_photo') ); ?>
			        <img src="<?php echo esc_url($photo_profile); ?>">
			    </div>
			    <div class="col span_1_of_2 body-msg">
					<?php if ( !empty($about_meta['wpsp_welcome_headline'][0]) ) : ?>
			            <h3><?php echo $about_meta['wpsp_welcome_headline'][0]; ?></h3>
			        <?php endif; ?>    
			        <?php if ( !empty($about_meta['wpsp_welcome_message'][0]) ) : ?>
			            <?php echo $about_meta['wpsp_welcome_message'][0]; ?>
			        <?php endif; ?>    
			    </div>
			</section> <!-- .welcome-message -->

			<section class="about-entry-content">
				<?php the_content(); ?>
			</section> <!-- .about-entry-content -->

			<section class="li-goal wpsp-row clear">
				<div class="col span_1_of_2">
					<div class="our-mission post-thumbnail-wrap overlay-1">
						<?php if ( !empty($about_meta['wpsp_mission_photo'][0]) ) : ?>
				            <img src="<?php echo wp_get_attachment_url($about_meta['wpsp_mission_photo'][0]);?>">
				        <?php endif; ?>
				        <div class="caption-wrap">
							<div class="caption-inner">
								<div class="entry-caption">
								<?php if ( !empty($about_meta['wpsp_mission_headline'][0]) ) : ?>
						            <h4><span class="h-sep"></span><?php echo $about_meta['wpsp_mission_headline'][0]; ?></h4>
						        <?php endif; ?>
						        <?php if ( !empty($about_meta['wpsp_mission_desc'][0]) ) : ?>
						            <p class="description"><?php echo $about_meta['wpsp_mission_desc'][0]; ?></p>
						        <?php endif; ?> 
					        	</div> <!-- .entry-caption -->
					        </div> <!-- .caption-inner -->
					    </div> <!-- .caption-wrap -->
			        </div> <!-- .our-mission -->
				</div> <!-- .col span_1_of_2 -->
				<div class="col span_1_of_2">
					<div class="our-value post-thumbnail-wrap overlay-1">
						<?php if ( !empty($about_meta['wpsp_value_photo'][0]) ) : ?>
				            <img src="<?php echo wp_get_attachment_url($about_meta['wpsp_value_photo'][0]);?>">
				        <?php endif; ?>
				        <div class="caption-wrap">
							<div class="caption-inner">
								<div class="entry-caption">
								<?php if ( !empty($about_meta['wpsp_value_headline'][0]) ) : ?>
						            <h4><span class="h-sep"></span><?php echo $about_meta['wpsp_value_headline'][0]; ?></h4>
						        <?php endif; ?>
						        <?php if ( !empty($about_meta['wpsp_value_desc'][0]) ) : ?>
						            <p class="description"><?php echo $about_meta['wpsp_value_desc'][0]; ?></p>
						        <?php endif; ?> 
					        	</div> <!-- .entry-caption -->
					        </div> <!-- .caption-inner -->
					    </div> <!-- .caption-wrap -->
			        </div> <!-- .our-value -->
				</div> <!-- .col span_1_of_2 -->
			</section> <!-- .li-goal -->

			<section class="our-work">
				<div class="container">
					<header class="section-title">
					<?php if ( !empty($about_meta['wpsp_program_headline'][0]) ) : ?>
			            <h2><?php echo $about_meta['wpsp_program_headline'][0]; ?></h2>
			        <?php endif; ?>    
			        <?php if ( !empty($about_meta['wpsp_program_desc'][0]) ) : ?>
			            <p class="description"><?php echo $about_meta['wpsp_program_desc'][0]; ?></p>
			        <?php endif; ?>    
			        </header>
			        <?php if ( !empty($about_meta['wpsp_main_program_page'][0]) ) : ?>
			        <div class="featured-page wpsp-row clear">
			    	<?php
			    		$page_count = 0;
			    		$args = array (
							'child_of' => $about_meta['wpsp_main_program_page'][0],
							'sort_column' => 'menu_order',
						); 
						$featured_pages = get_pages( $args );
						if ( !empty($featured_pages) ) {
							foreach ( $featured_pages as $page ) { 
								$page_count++;
								$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'large' );
				            	if ( $page_count == 1 ) {
				            		$image_url = aq_resize( $thumb_url[0], '415', '560', true);
				            	} else {
				            		$image_url = aq_resize( $thumb_url[0], '415', '270', true);
				            	}
				            	if ( $page_count <= 3 ) { 
				            		$entry_classes = array( 'page-entry-overlay' );
									$entry_classes[] = 'col';
									$entry_classes[] = wpsp_grid_class(2); 
									$entry_classes[] = 'col-' . $page_count; ?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( $entry_classes ); ?>>
										<div class="entry-page post-thumbnail-wrap overlay-1">
											<img src="<?php echo $image_url;?>">
											<div class="caption-wrap">
												<div class="caption-inner">
												<a href="<?php wpsp_permalink($page->ID);?>" rel="bookmark"><span class="title"><?php echo $page->post_title; ?></span></a>
												</div>
											</div>
										</div>
									</article> <!-- .page-entry-overlay -->

				            <?php }
							} 
						}?>
			        </div> <!-- .featured-page .clear -->
			    	<?php endif; ?>
		    	</div> <!-- .container -->
			</section> <!-- .our-work -->
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();