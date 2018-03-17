<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Http\Controllers\Controller;

class PropertiesController extends Controller
{
    //

    public function index()
    {
        $data['properties'] = Property::all();
        
        return view('frontend.properties', $data );
    }

    public function view(Property $property)
    {

        $data['property'] = $property;
        $data['json'] = $property->toJson();
        
        return view('frontend.property-view', $data);
    }
    
    public function getPropertyPrices()
    {
        return 'test';
    }

    
}
