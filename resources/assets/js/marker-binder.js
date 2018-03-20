module.exports = function(){

    var $prop = $('.prop');
    var markers, infoWindow, map, customImage, hoverImage;

    function bind( _map, _markers, _icons ) {
        markers = {} // clear

        map = _map;
        markers = _markers;
        customImage = _icons.base;
        hoverImage = _icons.hover;

        bindMarkerToProperties();
        bindPropertiesToMarkers();
        
    }

    function bindMarkerToProperties(){

        infoWindow = new google.maps.InfoWindow();

        Object.keys(markers).forEach(function(key) {            
            markers[key].addListener('click', function(){
                infoWindow.setContent(key);
                infoWindow.open(map, markers[key])
            })
        });

        map.addListener('click', function(){
            infoWindow.close();
        })
    }

    function bindPropertiesToMarkers() {
        $prop.hover(function() {
            highlightMarker( $(this) );
        });

        $prop.on('mouseout', function(){
            removeMarkerHighlight( $(this) )
        })
    }

    function highlightMarker( $el ) {
        var marker = markers['prop_' + $el.data('id')];
        if( marker ) {
            marker.setZIndex(10);
            marker.setIcon(hoverImage);
        }
    }

    function removeMarkerHighlight( $el ) {
        var marker = markers['prop_' + $el.data('id')];
        if( marker ) {
            marker.setIcon(customImage);            
            marker.setZIndex(5);
        }
    }

    return {
        init: bind
    }

}()