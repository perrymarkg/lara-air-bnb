module.exports = function(){

    var $search = $('#place_search');
    var $clone = $search.clone().removeAttr('id').attr('name', 'position');
    var searchbox;

    function init() {
        searchBox = new google.maps.places.SearchBox( $search.get(0) );
        $clone.appendTo( $search.parent() );
        searchBox.addListener('places_changed', function(places){
            places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }

            var loc = places[0].geometry.location
            $clone.val(loc.lat() + '|' + loc.lng());
        });
    }

    return {
        init: init
    }

}();