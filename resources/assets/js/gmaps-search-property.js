module.exports = function(){

    var $map = $('#gmap_properties');
    var $markers = $('#prop_markers');

    var map, defaultPosition, markers = {}, customImage, hoverImage;

    function init() {
        setMap();
        addMarkers();
    }

    function onInit( callback ){
        callback(markers, map, customImage, hoverImage);
    }

    function setMap() {

        map = new google.maps.Map( $map.get(0), {
            center: {lat: 0, lng: 0},
            zoom:2,
            mapTypeControl: false,
            streetViewControl: false,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP
            },
        });
    }

    function addMarkers() {
        var markerData = JSON.parse($markers.html());
        
        customImage = createCustomImage();
        hoverImage = createCustomImage('hover');

        markerData.forEach( function(el) {
            if( el.lat && el.lng ) {                
                markers['prop_' + el.id] = new google.maps.Marker({
                    position: {lat: Number(el.lat), lng: Number(el.lng) },
                    title: el.title,
                    map: map,
                    prop_id: el.id,
                    icon: customImage,
                    zIndex:5
                });

                markers['prop_' + el.id].addListener('mouseover', function(){
                    markers['prop_' + el.id].setIcon(hoverImage);
                });

                markers['prop_' + el.id].addListener('mouseout', function(){
                    markers['prop_' + el.id].setIcon(customImage);
                });
            }
        });

        
        
    }

    function createCustomImage(type = 'base') {

        var imageUrl = ( type != 'base') ? $markers.data('pinhover') : $markers.data('pin');


        var image = {
            url: imageUrl,
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(25, 48),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(13, 48)
          };
        return image;
    }
    
    function getMarkers() {
        return markers;
    }

    return {
        init: init,
        onInit: onInit
    }

}()