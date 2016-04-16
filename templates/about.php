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

$photo_profile = rwmb_meta('wpsp_profile_photo', array( 'type' => 'image_advanced') );
$photo_mission = rwmb_meta('wpsp_mission_photo', array( 'type' => 'image_advanced') );
$photo_vision = rwmb_meta('wpsp_vision_photo', array( 'type' => 'image_advanced') ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="welcome-message wpsp-row no-margin-grid clear">
				<div class="col span_1_of_2 photo-profile">
					<?php // display image meta
					if ( !empty( $photo_profile ) ) { 
					foreach ( $photo_profile as $image ) : ?>
			        	<img src="<?php echo $image['full_url']; ?>">
			    	<?php endforeach; 
			    	} // endif ?>
			    </div>
			    <div class="col span_1_of_2 body-msg">
					<?php if ( rwmb_meta('wpsp_welcome_headline') ) : ?>
			            <h3><?php echo rwmb_meta('wpsp_welcome_headline'); ?></h3>
			        <?php endif; ?>    
			        <?php if ( rwmb_meta('wpsp_welcome_message') ) : ?>
			            <?php echo rwmb_meta('wpsp_welcome_message'); ?>
			        <?php endif; ?>    
			    </div>
			</section> <!-- .welcome-message -->

			<section class="about-entry-content">
				<?php the_content(); ?>
			</section> <!-- .about-entry-content -->

			<section class="li-goal wpsp-row clear">
				<div class="col span_1_of_2">
					<div class="our-mission wpsp-image-hover background-color-green overlay-parent">
						<?php // display image meta
						if ( !empty( $photo_mission ) ) { 
						foreach ( $photo_mission as $image ) : ?>
				        	<img src="<?php echo $image['full_url']; ?>">
				    	<?php endforeach; 
				    	} // endif ?>
						<div class="overlay-headline headline-wrap">
							<span class="headline-inner">
								<?php if ( rwmb_meta('wpsp_mission_headline') ) : ?>
						            <h4><span class="h-sep"></span><?php echo rwmb_meta('wpsp_mission_headline'); ?></h4>
						        <?php endif; ?>
						        <?php if ( rwmb_meta('wpsp_mission_desc') ) : ?>
						            <p class="description"><?php echo rwmb_meta('wpsp_mission_desc'); ?></p>
						        <?php endif; ?> 
							</span>
						</div>
			        </div> <!-- .our-mission -->
				</div> <!-- .col span_1_of_2 -->

				<div class="col span_1_of_2">
					<div class="our-vision wpsp-image-hover background-color-blue overlay-parent">
						<?php // display image meta
						if ( !empty( $photo_vision ) ) { 
						foreach ( $photo_vision as $image ) : ?>
				        	<img src="<?php echo $image['full_url']; ?>">
				    	<?php endforeach; 
				    	} // endif ?>
						<div class="overlay-headline headline-wrap">
							<span class="headline-inner">
								<?php if ( rwmb_meta('wpsp_vision_headline') ) : ?>
						            <h4><span class="h-sep"></span><?php echo rwmb_meta('wpsp_vision_headline'); ?></h4>
						        <?php endif; ?>
						        <?php if ( rwmb_meta('wpsp_vision_desc') ) : ?>
						            <p class="description"><?php echo rwmb_meta('wpsp_vision_desc'); ?></p>
						        <?php endif; ?>
							</span>
						</div>
			        </div> <!-- .our-value -->
				</div> <!-- .col span_1_of_2 -->
			</section> <!-- .li-goal -->

			
		</main><!-- #main -->
	</div><!-- #primary -->		

<?php
get_sidebar();
get_footer();