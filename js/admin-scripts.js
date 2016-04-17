/**
 * Show/Hide metabox base on post format
 */

jQuery(document).ready(function($) {

	// Hide post format sections
	function hide_statuses() {
		$('#format-audio,#format-aside,#format-chat,#format-gallery,#format-image,#format-link,#format-quote,#format-status,#format-video').hide();
	}

	// Post Formats
	if($("#post-formats-select").length) {
		// Hide post format sections
		hide_statuses();

		// Supported post formats
		var post_formats = ['audio','aside','chat','gallery','image','link','quote','status','video'];

		// Get selected post format
		var selected_post_format = $("input[name='post_format']:checked").val();

		// Show post format meta box
		if(jQuery.inArray(selected_post_format,post_formats) != '-1') {
			$('#format-'+selected_post_format).show();
		}

		// Hide/show post format meta box when option changed
		$("input[name='post_format']:radio").change(function() {
			// Hide post format sections
			hide_statuses();
			// Shoe selected section
			if(jQuery.inArray($(this).val(),post_formats) != '-1') {
				$('#format-'+$(this).val()).show();
			}
		});
	}

	//Switch Metabox with template was loaded or selected
	var $masthead = $('#masthead'),
	$homepage = $('#homepage-options'),
	$about = $('#about-options'),
	$featured_pages = $('#featured-pages-options'),
	$video_post = $('#featured-videos-options'),
	$contact = $('#contact-options');
	
	function hide_meta_template() {
		$homepage.hide();
        $about.hide();
        $featured_pages.hide();
        $video_post.hide();
        $contact.hide();
        //default meta box
        $masthead.show();
	}

	if ( $('#page_template').length ) {
		hide_meta_template();
		
		var page_tempaltes = ['homepage', 'about', 'featured-pages', 'featured-videos', 'contact'];
		var selected_page_template = $('#page_template').val().replace('templates/', '').replace('.php', '');
		//console.log( selected_page_template );
		if(jQuery.inArray(selected_page_template,page_tempaltes) != '-1') {			
			$('#'+selected_page_template+'-options').show();
			if ( 'contact' == selected_page_template || 'home' == selected_page_template ) {
				$masthead.hide();
			}
		}

		$('#page_template').live('change', function(){
			hide_meta_template();
			selected_page_template = $(this).val().replace('templates/', '').replace('.php', '');
			//console.log( selected_page_template );
			if(jQuery.inArray(selected_page_template,page_tempaltes) != '-1') {			
				$('#'+selected_page_template+'-options').show();
				if ( 'contact' == selected_page_template || 'home' == selected_page_template ) {
					$masthead.hide();
				}
			}
		});
	} 

});