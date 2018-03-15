var bookingData = 0;
var roomData = 0;

const setBookingData = function( data ){
        bookingData = data
        $('.results').html('Called');
        calculate();
}

const setRoomData = function( data ){
        roomData = data
}

var calculate = function() {
        console.log( bookingData + roomData);
}

module.exports = {
        setBookingData: setBookingData,
        setRoomData: setRoomData
}
