/**
 * Tour Inclusion Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.tour_inclusion', {
        init : function( ed, url ) {
             ed.addButton( 'tour_inclusion', {
                title : 'Tour inclusion',
                image : url + '/ed-icons/list.png',
                onclick : function() {
                	var dummy = '<ul><li>Insert your content here.</li><li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li><li>Vivamus leo ante, consectetur sit amet vulputate vel, dapibus sit amet lectus.</li></ul>';
                    var nl = '<br /><br />';
                    var shortcode = '';
                    shortcode += '[tour_inclusion]' + nl;
                    shortcode += '[inclusion_section type="included"]' + dummy + '[/inclusion_section]' + nl;
                    shortcode += '[inclusion_section type="excluded"]' + dummy + '[/inclusion_section]' + nl;
                    shortcode += '[/tour_inclusion]';
                    ed.execCommand('mceInsertContent', 0, shortcode);
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'tour_inclusion', tinymce.plugins.tour_inclusion );
	
 } )();