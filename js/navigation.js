/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
( function( $ ) {
	var $menuToggle = $('.menu-toggle'),
		$contentWrapper = $('#page'),
		$siteMenuContainer = $('#sitemenu-container'),
		$innerMobileMenu = $('#inner-mobile-menu');

	//open-close mobile menu clicking on the menu icon
	$menuToggle.on('click', function(event){
		event.preventDefault();
		
		$menuToggle.toggleClass('is-clicked');
		$contentWrapper.toggleClass('active');
		$siteMenuContainer.toggleClass('menu-open');
		$innerMobileMenu.toggleClass('active');
	} );

	//close mobile menu clicking outside the menu itself
	$contentWrapper.on('click', function(event){
		if( !$(event.target).is( $menuToggle ) ) {
			$menuToggle.removeClass('is-clicked');
			$contentWrapper.removeClass('active');
			$siteMenuContainer.removeClass('menu-open');
			$innerMobileMenu.removeClass('active');
		}

	} );
} ) ( jQuery );
