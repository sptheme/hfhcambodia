<?php
 /**
 * Registering meta boxes
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 *
 * @package Habitat Cambodia
 */

 add_filter( 'rwmb_meta_boxes', 'wpsp_register_meta_boxes' );

/**
 * Register meta boxes
 *
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
	function wpsp_register_meta_boxes( $meta_boxes ) {
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'wpsp_';

	/* get the registered sidebars */
    global $wp_registered_sidebars;

    $sidebars = array();
    foreach( $wp_registered_sidebars as $id=>$sidebar ) {
      $sidebars[ $id ] = $sidebar[ 'name' ];
    }
    $sidebars_tmp = array_unshift( $sidebars, "-- Choose Sidebar --" );    

	// Homepage
    $meta_boxes[] = array(
    	'id'			=> 'homepage-options',
		'title'			=> __( 'Homepage Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Slideshow Photos', 'wpsp-meta-options' ), 
				'id'    => "slideshow_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Slide category', 'wpsp-meta-options' ), 
					'id'    => $prefix . "slide_category",
					'desc'	=> __( 'Select slider category', 'wpsp-meta-options' ), 
					'type'  => 'taxonomy',
					'options' => array(
						'taxonomy' => 'slider_category',
						'type'     => 'select',
						'args'     => array(),
					),
				),

			array(
				'name'  => __( 'Main programs', 'wpsp-meta-options' ), 
				'id'    => "main_programs_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Highlight the title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "program_headline_home",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "program_desc_home",
					'type'  => 'textarea',
					'row'	=> 3
				),
				array(
					'name'  => __( 'Display Main Programs Page', 'wpsp-meta-options' ), 
					'id'    => $prefix . "main_program_page_home",
					'desc'	=> __( 'Please select parent page that containe all of main programs. eg: Areas of Interest', 'wpsp-meta-options' ), 
					'type'  => 'post',
					'post_type' => 'page',
					'field_type'  => 'select_advanced',
					'placeholder' => __( 'Select an Item', 'wpsp-meta-options' ),
				),

			array(
				'name'  => __( 'Testimonial', 'wpsp-meta-options' ), 
				'id'    => "testimonial_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Testimonial', 'wpsp-meta-options' ), 
					'id'    => $prefix . "testimonial_headline_home",
					'type'  => 'text',
					'std'	=> __( 'Happy Donor & Supporter', 'wpsp-meta-options' ),
				),
				array(
					'name'  => __( 'Testimonial category', 'wpsp-meta-options' ), 
					'id'    => $prefix . "testimonial_category",
					'desc'	=> __( 'Select testimonial category', 'wpsp-meta-options' ), 
					'type'  => 'taxonomy',
					'options' => array(
						'taxonomy' => 'testimonials_category',
						'type'     => 'select',
						'args'     => array(),
					),
				),

			array(
				'name'  => __( 'Post highlight', 'wpsp-meta-options' ), 
				'id'    => "post_highlight_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Select category', 'wpsp-meta-options' ), 
					'id'    => $prefix . "highlight_category",
					'type'  => 'taxonomy_advanced',
					'options' => array(
						'taxonomy' => 'category',
						'type'     => 'select',
						'args'     => array(),
					),
				),

			array(
				'name'  => __( 'Latest Post', 'wpsp-meta-options' ), 
				'id'    => "latest_post_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Headline', 'wpsp-meta-options' ), 
					'id'    => $prefix . "latest_post_headline",
					'type'  => 'text',
					'std' => __( 'Latest Post', 'wpsp-meta-options' ), 
				),	
				array(
					'name'  => __( 'Post number', 'wpsp-meta-options' ), 
					'id'    => $prefix . "latest_post_number",
					'desc'	=> __( 'Enter number of post to show', 'wpsp-meta-options' ),
					'type' 	=> 'number',
					'min'  	=> 0,
					'max'  	=> 5,
					'step' 	=> 1,
					'std'  	=> 3,
				),
				array(
					'name'  => __( 'Post archive page', 'wpsp-meta-options' ), 
					'id'    => $prefix . "post_archive_page",
					'desc'	=> __( 'Select HFH activities archive Page', 'wpsp-meta-options' ), 
					'type'  => 'post',
					'post_type' => 'page',
					'field_type'  => 'select_advanced',
					'placeholder' => __( 'Select an Item', 'wpsp-meta-options' ),
				),
			array(
				'name'  => __( 'Publications', 'wpsp-meta-options' ), 
				'id'    => "publication_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Headline', 'wpsp-meta-options' ), 
					'id'    => $prefix . "publication_headline",
					'type'  => 'text',
					'std' => __( 'Download Publications', 'wpsp-meta-options' ), 
				),	
				array(
					'name'  => __( 'Post number', 'wpsp-meta-options' ), 
					'id'    => $prefix . "pub_post_number",
					'desc'	=> __( 'Enter number of post to show', 'wpsp-meta-options' ),
					'type' 	=> 'number',
					'min'  	=> 0,
					'max'  	=> 10,
					'step' 	=> 1,
					'std'  	=> 3,
				),		
		)
    );

	// About
    $meta_boxes[] = array(
    	'id'			=> 'about-options',
		'title'			=> __( 'About Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Welcome', 'wpsp-meta-options' ), 
				'id'    => "welcome_msg_fake_id",
				'desc'	=> __( 'Write welcome message of CEO/Managing Direcotr with photo', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "welcome_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Body message', 'wpsp-meta-options' ), 
					'id'    => $prefix . "welcome_message",
					'type'  => 'wysiwyg',
					'raw'   => false,
					'options' => array(
						'textarea_rows' => 4,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'  => __( 'Profile photo', 'wpsp-meta-options' ), 
					'id'    => $prefix . "profile_photo",
					'desc'  => __( 'Upload photo of CEO/Managing Director', 'wpsp-meta-options'),
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
			array(
				'name'  => __( 'Our Mission', 'wpsp-meta-options' ), 
				'id'    => "our_mission_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "mission_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "mission_desc",
					'type'  => 'textarea',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Background image', 'wpsp-meta-options' ), 
					'id'    => $prefix . "mission_photo",
					'desc'  => __( 'Upload background image for our mission, should be the same size as our value image', 'wpsp-meta-options'),
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
			array(
				'name'  => __( 'Our Vision', 'wpsp-meta-options' ), 
				'id'    => "our_value_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "vision_headline",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "vision_desc",
					'type'  => 'textarea',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Background image', 'wpsp-meta-options' ), 
					'id'    => $prefix . "vision_photo",
					'desc'  => __( 'Upload background image for our value, should be the same size as our mission image', 'wpsp-meta-options'),
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),			
		)
    );

    // Featured Video
    $meta_boxes[] = array(
    	'id'			=> 'featured-videos-options',
		'title'			=> __( 'Featured Video Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', 
		'priority'		=> 'high', 
		'autosave'		=> true,

		'fields'		=> array(
			array(
				'name'  => __( 'Select category', 'wpsp-meta-options' ), 
				'id'    => $prefix . "featured_video_cat",
				'type'  => 'taxonomy',
				'options' => array(
					'taxonomy' => 'category',
					'type'     => 'select', 
				),
			),
		)
    );	

	// Contact
    $meta_boxes[] = array(
    	'id'			=> 'contact-options',
		'title'			=> __( 'Contact Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.
		
		'fields'		=> array(	
			array(
				'name'  => __( 'Map', 'wpsp-meta-options' ), 
				'id'    => "map_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Location', 'wpsp-meta-options' ), 
					'id'    => $prefix . "marker",
					'type'  => 'map',
					'std'   => '11.546921,104.917905',
				),
		)
    );	

    // What we build page
    $meta_boxes[] = array(
    	'id'			=> 'what-we-build-options',
		'title'			=> __( 'Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'page' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Masthead', 'wpsp-meta-options' ), 
				'id'    => "masthead_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Upload background image', 'wpsp-meta-options' ), 
					'id'    => $prefix . "masthead_image",
					'desc'	=> __( 'Option: Recommended image size: 1600px by 640px.', 'wpsp-meta-options' ), 
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'  => __( 'Short description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "sub_headline",
					'type'  => 'wysiwyg',
					'raw'   => false,
					'options' => array(
						'textarea_rows' => 4,
						'teeny'         => true,
						'media_buttons' => false,
					),
				),
				array(
					'name'  => __( 'Button text', 'wpsp-meta-options' ), 
					'id'    => $prefix . "masthead_button_text",
					'desc' => __( 'Enter text for button. e.g: Learn more', 'wpsp-meta-options' ),
					'type'  => 'text',
					'std'  => 'Learn more',
				),
				array(
					'name'  => __( 'Button link', 'wpsp-meta-options' ), 
					'id'    => $prefix . "masthead_button_link",
					'desc' => __( 'URL/Link for slide (e.g: http://google.com).', 'wpsp-meta-options' ),
					'type'  => 'url',
				),
			array(
				'name'  => __( 'Callout Box 1', 'wpsp-meta-options' ), 
				'id'    => "callout_boxes_fake_id_1",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Upload image', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_image_1",
					'desc'	=> __( 'Optional: Recommended image size: 320px by 217px.', 'wpsp-meta-options' ), 
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'  => __( 'Title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_title_1",
					'type'  => 'text',
				),
				array(
					'name'  => __( 'Short description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_desc_1",
					'desc' => __( 'Recommended 25 characters', 'wpsp-meta-options' ),
					'type'  => 'textarea',
					'std'  => '',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Button text', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_button_text_1",
					'desc' => __( 'Enter text for button. e.g: Learn more', 'wpsp-meta-options' ),
					'type'  => 'text',
					'std'  => 'Learn more',
				),
				array(
					'name'  => __( 'Button link', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_button_link_1",
					'desc' => __( 'URL/Link for slide (e.g: http://google.com).', 'wpsp-meta-options' ),
					'type'  => 'url',
				),

			array(
				'name'  => __( 'Callout Box 2', 'wpsp-meta-options' ), 
				'id'    => "callout_boxes_fake_id_2",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Upload image', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_image_2",
					'desc'	=> __( 'Optional: Recommended image size: 320px by 217px.', 'wpsp-meta-options' ), 
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'  => __( 'Title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_title_2",
					'type'  => 'text',
				),
				array(
					'name'  => __( 'Short description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_desc_2",
					'desc' => __( 'Recommended 25 characters', 'wpsp-meta-options' ),
					'type'  => 'textarea',
					'std'  => '',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Button text', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_button_text_2",
					'desc' => __( 'Enter text for button. e.g: Learn more', 'wpsp-meta-options' ),
					'type'  => 'text',
					'std'  => 'Learn more',
				),
				array(
					'name'  => __( 'Button link', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_button_link_2",
					'desc' => __( 'URL/Link for slide (e.g: http://google.com).', 'wpsp-meta-options' ),
					'type'  => 'url',
				),		
			array(
				'name'  => __( 'Callout Box 3', 'wpsp-meta-options' ), 
				'id'    => "callout_boxes_fake_id",
				'desc'	=> __( '', 'wpsp-meta-options' ), 
				'type'  => 'heading'
			),
				array(
					'name'  => __( 'Upload image', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_image_3",
					'desc'	=> __( 'Optional: Recommended image size: 320px by 217px.', 'wpsp-meta-options' ), 
					'type'  => 'image_advanced',
					'max_file_uploads' => 1,
				),
				array(
					'name'  => __( 'Title', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_title_3",
					'type'  => 'text',
				),
				array(
					'name'  => __( 'Short description', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_desc_3",
					'desc' => __( 'Recommended 25 characters', 'wpsp-meta-options' ),
					'type'  => 'textarea',
					'std'  => '',
					'row'	=> 4
				),
				array(
					'name'  => __( 'Button text', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_button_text_3",
					'desc' => __( 'Enter text for button. e.g: Learn more', 'wpsp-meta-options' ),
					'type'  => 'text',
					'std'  => 'Learn more',
				),
				array(
					'name'  => __( 'Button link', 'wpsp-meta-options' ), 
					'id'    => $prefix . "callout_button_link_3",
					'desc' => __( 'URL/Link for slide (e.g: http://google.com).', 'wpsp-meta-options' ),
					'type'  => 'url',
				),
		)
    );

    // Slider post type
    $meta_boxes[] = array(
    	'id'			=> 'slider-options',
		'title'			=> __( 'Slider setting', 'wpsp-meta-options' ),
		'post_types'	=> array( 'slider' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Slide link', 'wpsp-meta-options' ), 
				'id'    => $prefix . "slide_link",
				'desc' => __( 'URL/Link for slide (e.g: http://google.com). You can keep it blank, if does not have link', 'wpsp-meta-options' ),
				'type'  => 'url',
				'std'  => '',
			),
			array(
				'name'  => __( 'Slide link', 'wpsp-meta-options' ), 
				'id'    => $prefix . "slide_link_target",
				'type'  => 'select',
				'options'     => array(
					'_blank' => __( 'Open link in new tab', 'wpsp-meta-options' ),
					'_self' => __( 'Open link in current tab', 'wpsp-meta-options' ),
				),
			),
		)
    );	
	
	// Portfolio post type
    /*$meta_boxes[] = array(
    	'id'			=> 'portfolio-options',
		'title'			=> __( 'Portfolio options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'portfolio' ),
		'context'		=> 'normal', 
		'priority'		=> 'high', 
		'autosave'		=> true, 

		'fields'		=> array(
			array(
				'name'  => __( 'Status', 'wpsp-meta-options' ), 
				'id'    => $prefix . "portfolio_status",
				'type'  => 'radio',
				'options' => array(
					'1' => __( 'In Progress', 'wpsp-meta-options' ),
					'2' => __( 'Suspended', 'wpsp-meta-options' ),
					'3' => __( 'Completed', 'wpsp-meta-options' ),
				),
			),
			array(
				'name'  => __( 'Number of progress', 'wpsp-meta-options' ), 
				'id'    => $prefix . "portfolio_progress",
				'desc'	=> __( 'Range from 0 to 100', 'wpsp-meta-options' ),
				'type'  => 'number',
				'min'  => 0,
				'max'  	=> 100,
				'step' => 10,
			),
		)
    );*/

	// Events post type
    $meta_boxes[] = array(
    	'id'			=> 'events-options',
		'title'			=> __( 'Personal information', 'wpsp-meta-options' ),
		'post_types'	=> array( 'events' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Location', 'wpsp-meta-options' ), 
				'id'    => $prefix . "event_location",
				'desc' => __( 'e.g: At Koh Pich City', 'wpsp-meta-options' ),
				'type'  => 'text',
				'std'  => '',
			),
			array(
				'name'  => __( 'Datetime', 'wpsp-meta-options' ), 
				'id'    => $prefix . "event_datetime",
				'type'  => 'datetime',
				'desc'  => __( 'Event start date and time', 'wpsp-meta-options' ), 
				'js_options' => array(
					'appendText'      => __( '(yyyy-mm-dd)', 'wpsp-meta-options' ),
					'dateFormat'      => __( 'yy-mm-dd', 'wpsp-meta-options' ),
					'stepMinute'      => 5,
					'showTimepicker'  => true,
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
		)
    );

	// Staff post type
    $meta_boxes[] = array(
    	'id'			=> 'staff-options',
		'title'			=> __( 'Personal information', 'wpsp-meta-options' ),
		'post_types'	=> array( 'staff' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Position', 'wpsp-meta-options' ), 
				'id'    => $prefix . "staff_position",
				'type'  => 'text',
			),
		)
    );

    // Partner post type
    $meta_boxes[] = array(
    	'id'			=> 'partner-options',
		'title'			=> __( 'Partner Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'partner' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Logo', 'wpsp-meta-options' ), 
				'id'    => $prefix . "partner_logo",
				'desc'	=> __( 'Upload logo image. File support .gif, .jpeg or png', 'wpsp-meta-options' ), 
				'type'  => 'image_advanced',
				'max_file_uploads' => 1
			),	
			array(
				'name'  => __( 'Website URL:', 'wpsp-meta-options' ), 
				'id'    => $prefix . "partner_url",
				'type' => 'url',
				'std'  => 'http://google.com',
			),
		)
    );

    // Publications post type
    $meta_boxes[] = array(
    	'id'			=> 'publication-options',
		'title'			=> __( 'Publication Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'publications' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'File Upload (En)', 'wpsp-meta-options' ), 
				'id'    => $prefix . "pub_file_en",
				'desc'  => __( 'Upload English version. Keep blank if do not have', 'wpsp-meta-options'),
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'application,pdf,doc,docx'
			),
			array(
				'name'  => __( 'File Upload (Kh)', 'wpsp-meta-options' ), 
				'id'    => $prefix . "pub_file_kh",
				'desc'  => __( 'Upload Khmer version. Keep blank if do not have', 'wpsp-meta-options'),
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => ''
			),
		)
    );

	// Testimonial post type
    $meta_boxes[] = array(
    	'id'			=> 'testimonial-options',
		'title'			=> __( 'Testimonial Options', 'wpsp-meta-options' ),
		'post_types'	=> array( 'testimonials' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Client name', 'wpsp-meta-options' ), 
				'id'    => $prefix . "testimonial_author",
				'desc'  => __( 'Name of the client giving the testimonial. Appear bellow testimonial.', 'wpsp-meta-options'),
				'type'  => 'text',
			),
			array(
				'name'  => __( 'Position / Location / Other', 'wpsp-meta-options' ), 
				'id'    => $prefix . "testimonial_other",
				'desc'  => __( 'The information that appears bellow client name. e.g: Donor, Australia', 'wpsp-meta-options'),
				'type'  => 'text',
			),
		)
    );

    // Post format video
    $meta_boxes[] = array(
    	'id'			=> 'format-video',
		'title'			=> __( 'Format video', 'wpsp-meta-options' ),
		'post_types'	=> array( 'post' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Video URL', 'wpsp-meta-options' ), 
				'id'    => $prefix . "post_video_embed",
				'desc'  => __( 'Enter Video Embed URL from youtube, vimeo or dailymotion', 'wpsp-meta-options'),
				'type'  => 'text',
			),
		)
    );

    // Post format gallery
    $meta_boxes[] = array(
    	'id'			=> 'format-gallery',
		'title'			=> __( 'Format gallery', 'wpsp-meta-options' ),
		'post_types'	=> array( 'post' ),
		'context'		=> 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'		=> 'high', // Order of meta box: high (default), low. Optional.
		'autosave'		=> true, // Auto save: true, false (default). Optional.

		'fields'		=> array(
			array(
				'name'  => __( 'Upload photos', 'wpsp-meta-options' ), 
				'id'    => $prefix . "format_gallery_album",
				'desc'  => __( 'Upload photo into album', 'wpsp-meta-options'),
				'type'  => 'image_advanced',
			),
		)
    );

	// Page layout options
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'page-options',
		'title'      => __( 'Page options', 'wpsp-meta-options' ),
		'post_types' => array( 'post', 'page', 'portfolio', 'staff' ),
		'context'    => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority'   => 'high', // Order of meta box: high (default), low. Optional.
		'autosave'   => true, // Auto save: true, false (default). Optional.

		// List of meta fields
		'fields'     => array(
			
			array(
				'name'  => __( 'Title align', 'wpsp-meta-options' ), 
				'id'    => $prefix . "post_title_align",
				'desc'	=> __( 'Align the title for this post/page', 'wpsp-meta-options' ), 
				'type'  => 'select',
				'options'     => array(
					'left' => __( 'Left', 'wpsp-meta-options' ),
					'right' => __( 'Right', 'wpsp-meta-options' ),
					'center' => __( 'Center', 'wpsp-meta-options' ),
					),
				'std'   => 'left'
			),	
			array(
				'name'  => __( 'Primary Sidebar', 'wpsp-meta-options' ), 
				'id'    => $prefix . "sidebar_primary",
				'desc'  => __( 'Overrides default', 'wpsp-meta-options' ),// Field description (optional)
				'type'  => 'select',
				// Array of 'value' => 'Image Source' pairs
				'options'  => $sidebars,
			),
			array(
				'name'  => __( 'Layout', 'wpsp-meta-options' ), 
				'id'    => $prefix . "layout",
				'desc'  => __( 'Overrides the default layout option', 'wpsp-meta-options' ),// Field description (optional)
				'type'  => 'image_select',
				'std'   => __( 'inherit', 'wpsp-meta-options' ),// Default value (optional)
				// Array of 'value' => 'Image Source' pairs
				'options'  => array(
					'inherit'  => get_template_directory_uri() . '/images/admin/layout-off.png',
					'col-1c'   => get_template_directory_uri() . '/images/admin/col-1c.png',
					'col-2cl'  => get_template_directory_uri() . '/images/admin/col-2cl.png',
					'col-2cr'  => get_template_directory_uri() . '/images/admin/col-2cr.png',
				),
			),
		)
	);	

	return $meta_boxes;
}