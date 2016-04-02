/**
 * main.js
 *
 * General scripts for theme
 * 
 */
( function( $ ) {
	//Make all the videos responsive with FitVids - http://fitvidsjs.com/ 
	$('#content').fitVids();
	
	//Equal Height Content
	if($.fn.matchHeight!=undefined){
		$('.equal-height-content').matchHeight();
	}
} ) ( jQuery );
