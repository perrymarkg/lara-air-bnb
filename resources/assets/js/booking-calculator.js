const moment = require('moment');

module.exports = function (
    checkIn = '#check_in', 
    checkOut = '#check_out', 
    guests = '#guests', 
    picker = '.guest-picker',
    result = '.booking-prices-result' ){
    
    var $checkIn = $(checkIn);
    var $checkOut = $(checkOut);
    var $guests = $(guests);
    var $picker = $(picker);
    var $bookingElements = $([checkIn, checkOut, guests].join(','));

    $result = $(result)

    function init() {
        
        $bookingElements.on('change', function() {
   
            if( $checkIn.val() != '' && $checkOut.val() != '' ){
                sendPostData();
            } else {
                $result.find('button').hide()
            }

       });
    }
    
    function sendPostData() {
        axios.post('/booking/compute', {
            property_id: prop_data.id,
            check_in: $checkIn.val(),
            check_out: $checkOut.val()
        })
        .then( function(result){
            displayBookingResult(result);
            $result.find('button').fadeIn();
        });
    }

    function displayBookingResult(result) {
        $result.find('.booking-prices-list').hide().html(result.data).fadeIn();
    }

    return {
        init: init
    }

}()
