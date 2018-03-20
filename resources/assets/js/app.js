/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
}); */

// Main


if($('#prop_data').length)
    window.prop_data = JSON.parse($('#prop_data').html()); // clean up

deleteModal = require('./modal');
date_picker = require('./date-range-picker');
booking_calculator = require('./booking-calculator');
guest_picker = require('./guest-picker');
gmapsEditProperty = require('./gmaps-edit-property');
gmapsMain = require('./gmaps-main');
gmapsMarkers = require('./gmaps-markers');
gmapsPlaceSearch = require('./gmaps-place-search');
markerBinder = require('./marker-binder');
propertyListingAjax = require('./property-listing-ajax');

(function($){
    $(document).ready(function (){
        
        deleteModal.init();
        date_picker.init();
        guest_picker.init();

        if( $('#prop_data').length ){
            $('#prop_data').html('');
            booking_calculator.init();
        }
        
    });

})(jQuery);

initMaps = function(){
    if( $('#gmap').is(':visible') ) {
        gmapsEditProperty.init();
    }
    if( $('#gmap_properties').is(':visible') ){
        propertyListingAjax.init();
        gmapsMain.init();
        gmapsMarkers.init( gmapsMain.getMap() );
        gmapsPlaceSearch.init(); 
        
        propertyListingAjax.onRender( gmapsMarkers.addMarkers );
        gmapsMarkers.onMarkerAdded( markerBinder.init );
    }
}

