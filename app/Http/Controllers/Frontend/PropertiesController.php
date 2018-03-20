<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class PropertiesController extends Controller
{
    //

    public function index()
    {
        $properties = Property::all();

        $markers = [];

        foreach($properties as $prop) {
            $markers[] = [
                'id' => $prop->id,
                'lat' => $prop->lat,
                'lng' => $prop->lng,
                'price' => \Helper::formatPrice($prop->price),
                'title' => $prop->title
            ];
        }
        $markers = json_encode($markers);
        return view('frontend.properties', compact('properties', 'markers') );
    }

    public function view(Property $property)
    {

        $data['property'] = $property;
        $data['json'] = $property->toJson();
        
        return view('frontend.property-view', $data);
    }
    
    public function getProperties()
    {
        $properties = Property::paginate(3);
        $properties->withPath('properties');
        foreach($properties as $prop) {
            $markers[] = [
                'id' => $prop->id,
                'lat' => $prop->lat,
                'lng' => $prop->lng,
                'price' => \Helper::formatPrice($prop->price),
                'title' => $prop->title
            ];
        }
         $data['html'] = view('components.property-listing', compact('properties'))->render();
        
        $data['markers'] = $markers;
        $data['marker_icons'] = ['base' => asset('storage/pin.png'), 'hover' => asset('storage/pin-hover.png')];
        return json_encode($data);
    }

    
}
