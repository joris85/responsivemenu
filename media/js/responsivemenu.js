jQuery(document).ready(function( $ ) {
    $(".mmenu-search-toggle").click(function(e) {
    	// Prevent default click action
	    // e.preventDefault();
	
        $(".mmenu-search").toggleClass("mmenu-search--open");
    });

    $(".mmenu-toggle").click(function(e) {
    	// Prevent default click action
	    e.preventDefault();

	    $("nav.mmenu, body").toggleClass("mmenu--open");
	    $(".responsive-menu").toggleClass("responsive-menu--open");
	    $(".mmenu-search").removeClass("mmenu-search--open");
    });

    $('html').click(function() {
        $("nav.mmenu, body").removeClass("mmenu--open");
	    $(".responsive-menu").removeClass("responsive-menu--open");
    });

	/* Prevent the menu close if we click in it */
    $('nav.mmenu, .mmenu-toggle').click(function(e) {
        e.stopPropagation();
    });

    $('a.sub-toggle').click(function() {
        $(this).closest('li').toggleClass('submenu-open');
        $(this).next('ul').toggleClass('submenu-open');
    });
});
