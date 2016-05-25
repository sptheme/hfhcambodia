/**
 * Career Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.career', {
        init : function( ed, url ) {
             ed.addButton( 'career', {
                title : 'Insert career',
                image : url + '/ed-icons/job.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'career Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-career-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'career', tinymce.plugins.career );
	jQuery( function() {
		var form = jQuery( '<div id="sc-career-form"><table id="sc-career-table" class="form-table">\
							<tr>\
							<th><label for="sc-career-number">Number of career</label></th>\
							<td><input type="text" name="sc-career-number" id="sc-career-number" value="-1" /></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-career-submit" class="button-primary" value="Insert career" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-career-submit' ).click( function() {
			var career_number = table.find( '#sc-career-number' ).val(),
			shortcode = '[sc_career post_num="' + career_number + '"]';
				
			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();