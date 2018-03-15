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

    
}
