/**
 * Itinerary Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.tour_itinerary', {
        init : function( ed, url ) {
             ed.addButton( 'tour_itinerary', {
                title : 'Insert an itinerary',
                image : url + '/ed-icons/itinerary.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Itinerary Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-itinerary-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'tour_itinerary', tinymce.plugins.tour_itinerary );
	jQuery( function() {
		var form = jQuery( '<div id="sc-itinerary-form"><table id="sc-itinerary-table" class="form-table">\
							<tr>\
							<th><label for="itinerary-new">New itinerary?</label></th>\
							<td>\
								<select id="itinerary-new" name="itinerary-new" size="1">\
									<option value="no" selected="selected">No</option>\
									<option value="yes">Yes</option>\
								</select>\
							</td>\
							</tr>\
							<tr>\
							<th><label for="section-title">Section title</label></th>\
							<td><input type="text" name="section-title" id="section-title" value="Day of itinerary goes here" /></td>\
							</tr>\
							<tr>\
							<th><label for="section-content">Title of day</label></th>\
							<td><textarea id="section-content" name="section-content" value="" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-itinerary-submit" class="button-primary" value="Insert itinerarys" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-itinerary-submit' ).click( function() {

			var is_itinerary = table.find( '#itinerary-new' ).val(),
			title = table.find('#section-title').val(),
			content = table.find('#section-content').val(),
			nl = '<br /><br />',
			shortcode = '';
			
			if (is_itinerary == 'yes'){
				shortcode += '[tour_itinerary]' + nl + '[itinerary_section';
			} else{
				shortcode += '[itinerary_section';
			}
			
			// Check if the title field is empty
			if (title) {
				shortcode += ' title=\"' + title + '\"]' + nl;
			}
			else {
				shortcode += ' title=\"Title Goes Here\"]' + nl;
			}
			
			// Check if the content field is empty
			if (content) {
				shortcode += content + nl;
			}
			else {
				shortcode += 'Content Goes Here' + nl;
			}
			
			// Check if this is a new itinerary
			if (is_itinerary == 'yes') {
				shortcode += '[/itinerary_section]' + nl + '[/tour_itinerary]'; 
			}
			else {
				shortcode += '[/itinerary_section]';
			}

			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();