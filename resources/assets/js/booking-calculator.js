const moment = require('moment');

module.exports = function(
    checkIn = '#check_in', 
    checkOut = '#check_out', 
    guests = '#guests', 
    picker = '.guest-picker',
    result = '.booking-prices-result' ){
    
    $check_in = $(checkIn);
    $check_out = $(checkOut);
    $guests = $(guests);
    $picker = $(picker);
    $booking_elements = $([checkIn, checkOut, guests].join(','));

    $result = $(result)
    
    $booking_elements.on('change', function(){
        
         total_nights = compute_total_nights($check_in.val(), $check_out.val());

        if( $check_in.val() != '' && $check_out.val() != '' ){
            
            axios.post('/booking/compute', {
                property_id: prop_data.id,
                check_in: $check_in.val(),
                check_out: $check_out.val()
            })
            .then( function(result){
                display_booking_result(result);
                $result.find('button').fadeIn();
            });
            
            
        } else {
            $result.find('button').hide()
        }

        
    })
    
    const compute_total_nights = function(check_in , check_out){
        no_days = 0;
        if( check_in && check_out){
            no_days = moment(check_out).diff( moment(check_in), 'days' );
        }
        return no_days;
    }
    
    const display_booking_result = function(result){        
        $result.find('.booking-prices-list').hide().html(result.data).fadeIn();
        
    }
}