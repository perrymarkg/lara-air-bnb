<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BookingController extends Controller
{
    //
    public function processBooking(Request $request)
    {
        $property = Property::findOrFail( $request->property_id );
    }

    public function confirmBooking(Request $request)
    {
    
        $property = Property::findOrFail( $request->property_id );

        $price_changed = $property->price != $request->property_price;
        
        $results = $this->getBookingPricesDetails($request, $property);
        
        $dates = [
            'text' => 'Dates: ',
            'val' => Carbon::createFromFormat('Y-m-d', $request->check_in)->format('M d, Y') . ' to ' . Carbon::createFromFormat('Y-m-d', $request->check_out)->format('M d, Y')
        ];

        array_unshift($results, $dates);
        
        $guest_json = json_decode($request->guests);
        
        $guest_val = $guest_json->adult . ' ' . str_plural('Adult', $guest_json->adult);
        if( $guest_json->child )
            $guest_val .= ' ' . $guest_json->child . ' ' . str_plural('Child', $guest_json->child);
        $guests = [
            'text' => 'Guests:',
            'val' => $guest_val
        ];

        array_unshift($results, $guests);

        $results_html = $this->getBookingPricesHtml($results);

        $data = compact('property', 'results_html', 'request', 'price_changed');

        return view('frontend.booking-confirm', $data );
    }
    

    public function getBookingPrices(Request $request)
    {
        $property = Property::findOrFail( $request->property_id );
        
        $results = $this->getBookingPricesDetails($request, $property);
        
        $response = $this->getBookingPricesHtml($results);

        return response()->json($response);
    }

    private function getTotalNights( $check_in, $check_out)
    {
        $start = Carbon::createFromFormat('Y-m-d', $check_in);
        $end = Carbon::createFromFormat('Y-m-d', $check_out);
        return $start->diffInDays($end);
    }

    private function getBookingPricesDetails(Request $request, Property $property)
    {
        $nights = $this->getTotalNights($request->check_in, $request->check_out );
        $nights_txt = $nights . ' ' .str_plural('Night', $nights) . ' X ' . \Helper::formatPrice($property->price);
        $results['nights'] = [ 
            'text' => $nights_txt, 
            'val' => \Helper::formatPrice($nights * $property->price) 
        ];
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
