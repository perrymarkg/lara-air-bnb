module.exports = function(){
    var $form = $('#property_search');
    var $place = $form.find('input[name="place"]');
    var $position = $place.clone().removeAttr('id').attr('name', 'position');
    var $checkIn = $('#check_in');
    var $checkOut = $('#check_out');
    var $guests = $('#guests');
    var searchbox, callback = function(checkIn, checkOut, guests, position){};

    function init() {
        setForm();
        setPlacesSearch();
    }

    function setForm() {
        $form.submit( function(e){
            e.preventDefault();
            callback($checkIn.val(), $checkOut.val(), $guests.val(), $position.val());
            
        })
    }

    function onFormSubmit( _callback ) {
        callback = _callback;
    }

    function setPlacesSearch() {
        searchBox = new google.maps.places.SearchBox( $place.get(0) );
        $position.appendTo( $place.parent() );
        searchBox.addListener('places_changed', function(places){
            places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }

            var loc = places[0].geometry.location
            var val = {lat: loc.lat(), loc:loc.lng()};
            $position.val(JSON.stringify(val));
        });
    }

    return {
        init: init,
        onFormSubmit: onFormSubmit
    }

}();