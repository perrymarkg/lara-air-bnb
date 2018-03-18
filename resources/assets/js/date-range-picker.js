
const flatpickr = require("flatpickr").default
const moment = require('moment');

module.exports = function(){
    
    var tmp = '';

    var checkIn = '#check_in';
    var checkOut = '#check_out';
    
    const checkInOpts = {
        altInput: true,
        altFormat: "M j, Y",
        dateFormat: "Y-m-d",
        minDate:"today",
        onClose: checkInClose
    }

    const checkOutOpts = {
        altInput: true,
        altFormat: "M j, Y",
        dateFormat: "Y-m-d",
        minDate:"today"
    }

    var checkInPickr;
    var checkOutPickr;

    function init() {
        checkInPickr = flatpickr(checkIn, checkInOpts);
        checkOutPickr = flatpickr(checkOut, checkOutOpts);
    }

    function checkInClose( selected, dateStr, instance) {        
        if( selected.length ) {
            checkOutPickr.set("minDate", new Date(moment(selected[0]).add('1', 'days'))  );
            $(checkOut).next().focus();
            checkOutPickr.open();        
        }
    }
    
    return {
        init:init
    }
    
}()


