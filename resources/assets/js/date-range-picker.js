
const flatpickr = require("flatpickr").default
const moment = require('moment');

const date_range_picker = function( callback = null, checkIn = '#check_in', checkOut = '#check_out' ){
    
    var tmp = '';
    
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
        minDate:"today",
        onClose: checkOutClose
    }

    const _checkIn = flatpickr(checkIn, checkInOpts);
    const _checkOut = flatpickr(checkOut, checkOutOpts);

    function checkInClose( selected, dateStr, instance) {        
        _checkOut.set("minDate", new Date(moment(selected[0]).add('1', 'days'))  );

        if( selected.length ) {
            $(checkOut).next().focus();
            _checkOut.open();        
        }
    }

    function checkOutClose( selected, dateStr, instace) {
        
        if( callback )
            callback(2);
    }


}

module.exports = date_range_picker
