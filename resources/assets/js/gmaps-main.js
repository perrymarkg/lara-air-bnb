module.exports = function(){

    var $map = $('#gmap_properties');
    var $markers;

    var map, defaultPosition, markers = {}, customImage, hoverImage;

    function init() {
        setMap();
    }

    function setMap() {

        map = new google.maps.Map( $map.get(0), {
            center: {lat: 0, lng: 0},
            zoom:5,
            mapTypeControl: false,
            streetViewControl: false,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_TOP
            },
        });
    }

    function getMap() {
        return map;
    }

    return {
        init: init,
        getMap: getMap
    }

}()