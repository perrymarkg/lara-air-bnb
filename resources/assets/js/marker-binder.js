module.exports = function(){

    var $prop = $('.prop');
    var markers, infoWindow, map, customImage, hoverImage;

    function bind( _markers, _map, _customImage, _hoverImage ) {
        map = _map;
        markers = _markers;
        customImage = _customImage;
        hoverImage = _hoverImage;

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
        $prop.on('mouseenter', function() {
            highlightMarker( $(this) );
        });

        $prop.on('mouseout', function(){
            removeMarkerHighlight( $(this) )
        })
    }

    function highlightMarker( $el ) {
        var marker = markers['prop_' + $el.data('id')];
        /* 
        var newLabel = {label: label, fontSize: '10px'} */
        if( marker ) {
            marker.setZIndex(10);
            marker.setIcon(hoverImage);
            marker.setAnimation(google.maps.Animation.BOUNCE);            
        }
    }

    function removeMarkerHighlight( $el ) {
        var marker = markers['prop_' + $el.data('id')];
        if( marker ) {
            marker.setIcon(customImage);
            marker.setAnimation(null);
            marker.setZIndex(5);
        }
    }

    return {
        init: bind
    }

}()