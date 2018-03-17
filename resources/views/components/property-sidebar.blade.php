property sidebar
<form action=" {{ route('booking.request') }} " method="POST" id="booking_form">
    {{ csrf_field() }}
    <input type="hidden" id="property_id" value=" {{ $property_id }} ">
    <div class="col-md-12">
        <div class="date-picker row">
            <div class="col-md-4 p-0">
                <input class="form-control bg-white" type="text" placeholder="Check In." id="check_in">
            </div>
            <div class="col-md-4 p-0">
                <input class="form-control bg-white" type="text" placeholder="Check Out" id="check_out">    
            </div>
            <div class="col-md-4 p-0">
                <input class="form-control bg-white" type="text"  placeholder="1 Guest" id="guests">
            </div>
        </div>
    </div>
    <div class="booking-prices-result row">
        <div class="booking-prices-list col-md-12">
            
        </div>
        <div class="booking-btn col-md-12">
            <button class="btn btn-primary btn-block">Request To Book</button>
        </div>
    </div>
    
</form>