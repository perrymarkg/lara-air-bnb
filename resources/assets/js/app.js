/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

// Main
window.prop_data = JSON.parse($('#prop_data').html());
deleteModal = require('./modal');
date_picker = require('./date-range-picker');
booking_calculator = require('./booking-calculator');
guest_picker = require('./guest-picker');

(function($){
    $(document).ready(function (){
        
        $('#prop_data').html('');
        deleteModal();
        date_picker();
        guest_picker();
        booking_calculator();
      
    });

})(jQuery);

