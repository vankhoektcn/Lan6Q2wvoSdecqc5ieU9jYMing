if (typeof landing == 'undefined')
	var landing = {};
if (typeof landing.index == 'undefined')
	landing.index = {};

landing.index = {
    init: function () 
    {
    	var thisObj = landing.index;
    	thisObj.pageLoad();
    	thisObj.events();
    },
    events: function () {
    },
    pageLoad: function(){
        landing.index.initMap();
    },
    initMap: function(){
        google.maps.event.addDomListener(window, 'load', 
            function() {
                
                // mapInitAddress("narodowa 18 Pruszków","featured-map1","images/pin-house.png", false);                
                // //mapInit(40.6128,-73.7903,"featured-map1","/frontend/images/pin-house.png", false);
                // mapInit(40.7222,-73.7903,"featured-map2","images/pin-apartment.png", false);
                // mapInit(41.0306,-73.7669,"featured-map3","images/pin-land.png", false);
                // mapInit(41.3006,-72.9440,"featured-map4","images/pin-commercial.png", false);
                // mapInit(42.2418,-74.3626,"featured-map5","images/pin-house.png", false);
                // mapInit(38.8974,-77.0365,"featured-map6","images/pin-apartment.png", false);
                // mapInit(38.7860,-77.0129,"featured-map7","images/pin-house.png", false);
                
                // mapInit(41.2693,-70.0874,"grid-map1","images/pin-house.png", false);
                // mapInit(33.7544,-84.3857,"grid-map2","images/pin-apartment.png", false);
                // mapInit(33.7337,-84.4443,"grid-map3","images/pin-land.png", false);
                // mapInit(33.8588,-84.4858,"grid-map4","images/pin-commercial.png", false);
                // mapInit(34.0254,-84.3560,"grid-map5","images/pin-apartment.png", false);
                // mapInit(40.6128,-73.9976,"grid-map6","images/pin-house.png", false);
            
                for (var i = 0; i < 10; i++) {
                    var idMapStr = "featured-map-"+i;
                    var idMap = "#featured-map-"+i, latitude = $(idMap).data('latitude') , longitude = $(idMap).data('longitude') ;
                    if( $(idMap).length && latitude && longitude) {
                        mapInit(latitude, longitude, idMapStr, "/frontend/images/pin-house.png", false);
                    }
                };
                
                for (var i = 0; i < 10; i++) {
                    var idMapStr = "lít-map-"+i;
                    var idMap = "#list-map-"+i, latitude = $(idMap).data('latitude') , longitude = $(idMap).data('longitude') ;
                    if( $(idMap).length && latitude && longitude) {
                        mapInit(latitude, longitude, idMapStr, "/frontend/images/pin-house.png", false);
                    }
                };
            }
        );
    }

};

$(function () {
	landing.index.init();
});
