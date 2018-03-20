module.exports = function(){

    var map, callback;
    var customImage = '';
    var markers = {};

    function init( _map ) {
        map = _map;
    }

    function addMarkers( _markers, icons ) {
        
        clearMarkers();

        _markers.forEach( function(el) {
            if( el.lat && el.lng ) {                
                markers['prop_' + el.id] = new google.maps.Marker({
                    position: {lat: Number(el.lat), lng: Number(el.lng) },
                    title: el.title,
                    map: map,
                    prop_id: el.id,
                    icon: icons.base,
                    zIndex:5
                });

                markers['prop_' + el.id].addListener('mouseover', function(){
                    markers['prop_' + el.id].setIcon(icons.hover);
                });

                markers['prop_' + el.id].addListener('mouseout', function(){
                    markers['prop_' + el.id].setIcon(icons.base);
                });
            }
        });

        setMapCenter();

        callback(map, markers, icons);
    }

    function clearMarkers() {
        Object.keys(markers).forEach(function(key) {
            markers[key].setMap(null);
        });
        markers = {};
    }

    function onMarkerAdded( _callback ) {
        callback = _callback;
    }

    function setMapCenter() {
        if( markers.length )
        map.setCenter( markers[Object.keys(markers)[0]].position );
    }

    

    return {
        init: init,
        addMarkers: addMarkers,
        onMarkerAdded: onMarkerAdded
    }

}()