module.exports = function() {
    var map;
    var marker;
    var search_box;
    var $lat = $('#map_lat');
    var $lng = $('#map_lng');
    var $map = $('#gmap');
    var $search = $('#gmap_search');

    function init()
    {
        setMap();
    }

    function setMap()
    {
        default_position = latLngHasValues() ? {lat: Number($lat.val()), lng: Number($lng.val()) } : {lat: -34.397, lng: 150.644};
        
        search_box = new google.maps.places.SearchBox( $search.get(0) );
        map = new google.maps.Map( $map.get(0), {
            center: default_position,
            zoom: 12
        });
        marker = new google.maps.Marker({
            position: default_position,            
            draggable:true,
            title:"Drag me!"
        });

        latLngHasValues() ? marker.setMap(map) : '';
        
        marker.addListener('dragend', dragend);
        
        search_box.addListener('places_changed', setMapCenter)
    }

    function dragend(event)
    {    
        setInputLatLng( event.latLng.lat(), event.latLng.lng() );
    }

    function setMapCenter(event)
    {
        places = search_box.getPlaces();
        if (places.length == 0) {
            return;
        }
        loc = places[0].geometry.location

        if( !marker.getMap() ){
            marker.setMap(map);
        }
            
        marker.setPosition(loc);
        map.setCenter(loc);
        setInputLatLng(loc.lat(), loc.lng());
    }

    function setInputLatLng(lat, lng)
    {
        $lat.val(lat)
        $lng.val(lng)
    }

    function latLngHasValues(){
        return ( $lat.val() != '' && $lng.val() != '') ? true : false;
    }

    return {
        init: init
    }

}()