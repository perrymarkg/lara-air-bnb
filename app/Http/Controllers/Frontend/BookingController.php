<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
Use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BookingController extends Controller
{
    //
    public function process(Request $request)
    {
        $data = json_decode($request->data);

        // @Todo Validate once more in case data changed
        $property = Property::findOrFail( $data->property_id );

        $nights = $this->getTotalNights($data->check_in, $data->check_out);

        
        $details = json_encode([
            // Store it in case user is deleted
            'user_details' => [
                'first_name' => \Auth::user()->first_name,
                'last_name' => \Auth::user()->last_name,
                'email' => \Auth::user()->email,
                'phone' => \Auth::user()->phone
            ],
            'guest_details' => [
                'adult' => $data->adult,
                'child' => $data->child,
                'total' => $data->total_guests
            ]
        ]);

        $booking_data = [
            'user_id' => \Auth::user()->id,
            'property_id' => $data->property_id,
            'status' => 1,
            'check_in' => $data->check_in,
            'check_out' => $data->check_out,
            'details' => $details
        ];

        try{
            // @Todo make table fields unique to avoid same bookings from the user
            $booking = new Booking();
            $booking->fill($booking_data);
            $booking->save();

            return redirect( route('property.view', $property->id) );
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
    }

    public function confirm(Request $request)
    {
    
        $property = Property::findOrFail( $request->property_id );

        $price_changed = $property->price != $request->property_price;
        
        $total_nights = $this->getTotalNights( $request->check_in, $request->check_out );

        $results = $this->getBookingPricesDetails($request, $property);

        $results_html = $this->getBookingPricesHtml($results);
        
        $guests = json_decode($request->guests);

        $json_data = json_encode([
            'property_id' => $request->property_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'nights' => $total_nights,
            'property_price' => $property->price, 
            'adult' => $guests->adult,
            'child' => $guests->child,
            'total_guests' => $guests->total,
            'total_price' => $total_nights * $property->price
        ]);

        $data = compact('property', 'results_html', 'request', 'price_changed', 'json_data');

        return view('frontend.booking-confirm', $data );
    }
    

    public function compute(Request $request)
    {
        $property = Property::findOrFail( $request->property_id );
        
        $results = $this->getBookingPricesDetails($request, $property, ['nights']);
        
        $response = $this->getBookingPricesHtml($results);

        return response()->json($response);
    }

    private function getTotalNights( $check_in, $check_out)
    {
        $start = Carbon::createFromFormat('Y-m-d', $check_in);
        $end = Carbon::createFromFormat('Y-m-d', $check_out);
        return $start->diffInDays($end);
    }

    private function getBookingPricesDetails(Request $request, Property $property, $only = null)
    {
        if( ( is_array($only) && in_array('nights', $only) ) || !$only ) {
            $nights = $this->getTotalNights($request->check_in, $request->check_out );
            $nights_txt = $nights . ' ' .str_plural('Night', $nights) . ' X ' . \Helper::formatPrice($property->price);
            $results['nights'] = [ 
                'text' => $nights_txt, 
                'val' => \Helper::formatPrice($nights * $property->price) 
            ];
        }
        
        if( ( is_array($only) && in_array('dates', $only) ) || !$only ){
            $results['dates'] = [
                'text' => 'Dates: ',
                'val' => Carbon::createFromFormat('Y-m-d', $request->check_in)->format('M d, Y') . ' to ' . Carbon::createFromFormat('Y-m-d', $request->check_out)->format('M d, Y')
            ];
        }
        
        if( ( is_array($only) && in_array('guests', $only) ) || !$only ){
            $guest_json = json_decode($request->guests);
        
            $guest_val = $guest_json->adult . ' ' . str_plural('Adult', $guest_json->adult);
            if( $guest_json->child )
                $guest_val .= ' ' . $guest_json->child . ' ' . str_plural('Child', $guest_json->child);
            $results['guests'] = [
                'text' => 'Guests:',
                'val' => $guest_val
            ];
        }
        

        return $results;
    }

    private function getBookingPricesHtml(Array $results)
    {
        $html = '';
        if( !empty($results) ){
            $html .= '<div class="list-group">';
            foreach($results as $result){
                $html .= '<div class="list-group-item d-flex justify-content-between align-items-center">';
                $html .= $result['text'] . ' <span>'. $result['val'].'</span>';
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        return $html;
    }

}
