<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BookingController extends Controller
{
    //

    public function getBookingPrices(Request $request)
    {
        $request = $request->only(['property_id', 'check_in', 'check_out']);
        
        $results = $this->getBookingPricesDetails($request);
        
        $response = $this->getBookingPricesHtml($results);

        return response()->json($response);
    }

    private function getTotalNights( $check_in, $check_out)
    {
        $start = Carbon::createFromFormat('Y-m-d', $check_in);
        $end = Carbon::createFromFormat('Y-m-d', $check_out);
        return $start->diffInDays($end);
    }

    private function getBookingPricesDetails($data)
    {
        
        $property = Property::findOrFail( $data['property_id'] );

        $total_nights = $this->getTotalNights($data['check_in'], $data['check_out'] );
        $results[] = [ 
            'text' => $total_nights . ' ' .str_plural('Night', $total_nights) . ' * ' . \Helper::formatPrice($property->price), 
            'val' => \Helper::formatPrice($total_nights * $property->price) 
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
