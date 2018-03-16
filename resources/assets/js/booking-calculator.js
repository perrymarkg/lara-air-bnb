const moment = require('moment');

module.exports = function(checkIn = '#check_in', checkOut = '#check_out', guests = '#guests', picker = '.guest-picker'){
    
    $check_in = $(checkIn);
    $check_out = $(checkOut);
    $guests = $(guests);
    $picker = $(picker);
    $booking_elements = $([checkIn, checkOut, guests].join(','));
    
    $booking_elements.on('change', function(){
        axios.get('/').then( function(result){
            console.log(result);
        });
        compute_total_days($check_in.val(), $check_out.val())
    })
    
    const compute_total_days = function(check_in , check_out){
        if( check_in && check_out){
            no_days = moment(check_out).diff( moment(check_in), 'days' );
            console.log(no_days);
        }
    }
    
}