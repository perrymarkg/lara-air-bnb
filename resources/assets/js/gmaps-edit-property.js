module.exports = function() {
    var map;
    var marker;
    var searchBox;
    var $lat = $('#map_lat');
    var $lng = $('#map_lng');
    var $map = $('#gmap');
    var $search = $('#gmap_search');

    function init() {
        if( $map.is(':visible') ){
            setMap();
            setSearchBox();
            setMarker();
        }
    }

    function setMap() {

        defaultPosition = latLngHasValues() ? {lat: Number($lat.val()), lng: Number($lng.val()) } : {lat:0, lng: 0};

        map = new google.maps.Map( $map.get(0), {
            center: defaultPosition,
            zoom: 12
        });
        
    }

    function setMarker() {

        marker = new google.maps.Marker({
            position: defaultPosition,            
            draggable:true,
            title:"Drag me!"
        });

        marker.addListener('dragend', dragend);
        latLngHasValues() ? marker.setMap(map) : '';

    }

    function setSearchBox() {
        searchBox = new google.maps.places.SearchBox( $search.get(0) );
        searchBox.addListener('places_changed', setMapCenter);
    }

    function dragend(event) {
        setInputLatLng( event.latLng.lat(), event.latLng.lng() );
    }

    function setMapCenter(event) {

        places = searchBox.getPlaces();
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

    function setInputLatLng(lat, lng) {
        $lat.val(lat)
        $lng.val(lng)
    }

    function latLngHasValues() {
        return ( $lat.val() != '' && $lng.val() != '') ? true : false;
    }

    return {
        init: init
    }

}()