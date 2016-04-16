/**
 * Callout Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.callout', {
        init : function( ed, url ) {
             ed.addButton( 'callout', {
                title : 'Insert Callout Box',
                image : url + '/ed-icons/callout-box.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Callout box options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-callout-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'callout', tinymce.plugins.callout );
	jQuery( function() {
		var form = jQuery( '<div id="sc-callout-form"><table id="sc-callout-table" class="form-table">\
							<tr>\
							<th><label for="sc-callout-message">Callout message</label></th>\
							<td><textarea name="" id="sc-callout-message" value="" cols="50" rows="5"></textarea></td>\
							</tr>\
							<tr>\
							<th><label for="sc-button-name">Button name</label></th>\
							<td><input type="text" name="sc-button-name" id="sc-button-name" value="" /></td>\
							</tr>\
							<tr>\
							<th><label for="sc-button-url">Button URL/Link</label></th>\
							<td><input type="text" name="sc-button-url" id="sc-button-url" value="" /> <small> ex: http://www.google.com</small></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-callout-submit" class="button-primary" value="Insert Callout" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-callout-submit' ).click( function() {
			var callout_message = table.find( '#sc-callout-message' ).val(),
			btn_name = table.find( '#sc-button-name' ).val(),
			btn_url = table.find( '#sc-button-url' ).val(),
			shortcode = '[callout_box button_name="' + btn_name + '" button_url="' + btn_url + '"]';
			shortcode += callout_message;
			shortcode += '[/callout_box]';


			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();