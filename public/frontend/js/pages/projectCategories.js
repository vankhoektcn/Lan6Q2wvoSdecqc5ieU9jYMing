if (typeof landing == 'undefined')
	var landing = {};
if (typeof landing.projectCategories == 'undefined')
	landing.projectCategories = {};

landing.projectCategories = {
	init: function () 
	{
		var thisObj = landing.projectCategories;
		thisObj.pageLoad();
		thisObj.events();
	},
	events: function () {
	},
	pageLoad: function(){
        landing.projectCategories.initowlCarousel();
    },
    initowlCarousel: function(){
        if( $("#featured-offers-owl-0").length ) {	
            $("#featured-offers-owl-0").owlCarousel({
                items : 3,
                itemsDesktop : [1182,2],
                itemsDesktopSmall : [974,2],
                itemsTablet: [750,2],
                itemsTabletSmall: false,
                itemsMobile: [479,1],
                mouseDrag: false
            });
            
            $("#featured-offers-owl-0-next").click( function ( event ) {
                event.preventDefault();
                $("#featured-offers-owl-0").data('owlCarousel').next();
            });	
            $("#featured-offers-owl-0-prev").click( function ( event ) {
                event.preventDefault();
                $("#featured-offers-owl-0").data('owlCarousel').prev();
            });
        }
    
        if( $("#featured-offers-owl-1").length ) {	
            $("#featured-offers-owl-1").owlCarousel({
                items : 3,
                itemsDesktop : [1182,2],
                itemsDesktopSmall : [974,2],
                itemsTablet: [750,2],
                itemsTabletSmall: false,
                itemsMobile: [479,1],
                mouseDrag: false
            });
            
            $("#featured-offers-owl-1-next").click( function ( event ) {
                event.preventDefault();
                $("#featured-offers-owl-1").data('owlCarousel').next();
            });	
            $("#featured-offers-owl-1-prev").click( function ( event ) {
                event.preventDefault();
                $("#featured-offers-owl-1").data('owlCarousel').prev();
            });
        }
        
        if( $("#featured-offers-owl-2").length ) {	
            $("#featured-offers-owl-2").owlCarousel({
                items : 3,
                itemsDesktop : [1182,2],
                itemsDesktopSmall : [974,2],
                itemsTablet: [750,2],
                itemsTabletSmall: false,
                itemsMobile: [479,1],
                mouseDrag: false
            });
            
            $("#featured-offers-owl-2-next").click( function ( event ) {
                event.preventDefault();
                $("#featured-offers-owl-2").data('owlCarousel').next();
            });	
            $("#featured-offers-owl-2-prev").click( function ( event ) {
                event.preventDefault();
                $("#featured-offers-owl-2").data('owlCarousel').prev();
            });
        }
    }

};

$(function () {
	landing.projectCategories.init();
});
