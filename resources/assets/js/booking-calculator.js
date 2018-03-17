const moment = require('moment');

module.exports = function(
    checkIn = '#check_in', 
    checkOut = '#check_out', 
    guests = '#guests', 
    picker = '.guest-picker',
    result = '.booking-price-list' ){
    
    $check_in = $(checkIn);
    $check_out = $(checkOut);
    $guests = $(guests);
    $picker = $(picker);
    $booking_elements = $([checkIn, checkOut, guests].join(','));

    $result = $(result)
    
    $booking_elements.on('change', function(){
        
         total_nights = compute_total_nights($check_in.val(), $check_out.val());

        if( $check_in.val() != '' && $check_out.val() != '' ){
            /* axios.get('/property_prices').then( function(result){
                console.log(result);
            }); */
            
            total_price = (prop_data.price * total_nights).toFixed(2);
            console.log(typeof prop_data.price, typeof total_nights);
            $result.html(' \
            <div class="list-group">\
                <div class="list-group-item d-flex justify-content-between align-items-center">\
                Length of stay <span>' + total_nights + ' Nights</span>\
                </div>\
                <div class="list-group-item d-flex justify-content-between align-items-center">\
                Total Price: <span>'+ total_price +'</span>   \
                </div>\
            </div>\
            ');
        }
        
    })
    
    const compute_total_nights = function(check_in , check_out){
        no_days = 0;
        if( check_in && check_out){
            no_days = moment(check_out).diff( moment(check_in), 'days' );
        }
        return no_days;
    }
    
}