module.exports = function() {
    var $map;

    var $marker;

    var $search_box;

    var $this = this;

    function initMap()
    {
        $map = $('#gmap');
        $search = $('#gmap_search');
        
        this.$search_box = new google.maps.places.SearchBox( document.getElementById('gmap_search') );
        this.$map = new google.maps.Map( $map.get(0), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 10
          });
        this.$marker = new google.maps.Marker({
            position: {lat: -34.397, lng: 150.644},
            map: this.$map,
            draggable:true,
            title:"Drag me!"
          });

        this.$marker.addListener('dragend', dragend);
        
        this.$search_box.addListener('places_changed', setMapCenter)
        
        

    }

    function dragend(event)
    {
        $('#map_lat').val(event.latLng.lat());
        $('#map_lng').val(event.latLng.lng());
    }

    function setMapCenter(event)
    {
        console.log(typeof event);
    }

    return {
        initMap: initMap
    }

}()