<?php

namespace App\Http\Controllers\Profile;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Country;

class PropertyController extends Controller
{
    //

    public function index()
    {
        $data['properties'] = Property::where('user_id', \Auth::user()->id)->get();        
        return view('profile.properties', $data);
    }

    public function create()
    {
        if( \Auth::user()->can('notCreate') ){
            return redirect( route('profile.properties.index') )
                ->withErrors(['Invalid access']);
        }

        $data['property'] = new Property();
        $data['submit_url'] = route('profile.properties.store');
        $data['mode'] = 'create';
        return view('profile.edit-property', $data);
    }

    public function show(Property $property)
    {
        return redirect( route('profile.properties.edit', $property->id) );
    }

    public function edit(Property $property)
    {
        if( !\Auth::user()->can('access', $property) ){
            return redirect( route('profile.properties.index') )
                ->withErrors(['Invalid access']);
        }
            
        $data['property'] = $property;
        $data['submit_url'] = route('profile.properties.update', $property->id);
        $data['mode'] = 'edit';
        return view('profile.edit-property', $data);
    }

    public function update(Request $request, $id)
    {
        $property = Property::find($id);

        if( !\Auth::user()->can('access', $property) ){
            return redirect( route('profile.properties.index') )
                ->withErrors(['Invalid access']);
        }

        $input = $this->requestCleanInput($request);

        $result = $this->validateForm($input);
        if( $result ){
            return $result;
        }

        return $this->saveProperty($property, $input);
    }

    public function store(Request $request)
    {
        if( \Auth::user()->can('notCreate') ){
            return redirect( route('profile.properties.index') )
                ->withErrors(['Invalid access']);
        }

        $input = $this->requestCleanInput($request);

        $result = $this->validateForm($input);
        if( $result ){
            return $result;
        }

        return $this->createProperty($input);
    }

    public function destroy($id)
    {
        $property = Property::find($id);
        
        if( !\Auth::user()->can('access', $property) ){
            return redirect( route('profile.properties.index') )
                ->withErrors(['Invalid access']);
        }

        $property->delete();

        return redirect( route('profile.properties.index') )
            ->with('status', __('Property deleted successfully') );
    }

    private function requestCleanInput(Request $request)
    {
        $fields = [
            'title', 'address','phone', 'country_id',
            'price', 'type', 'max_kids', 'max_adults',
            'bedrooms', 'beds', 'baths', 'description',
            'rules', 'cancellation', 'lat', 'lng'
        ];

        $result = $request->only($fields);

        $result['price'] = str_replace(',', '', $result['price']);

        return $result;
    }

    private function validateForm($input)
    {
        $rules = [
            'title' => 'required|max:255',
            'country_id' => 'required',
            'type' => 'required',
            'price' => 'regex:/^\d*(\.\d{1,2})?$/|required|min:0',
            'address' => 'required',
            'lat' => 'required'
        ];

        $messages = [
            'country_id.required' => 'Country field is required',
            'lat.required' => 'Google map position is required'
        ];

        $validator = Validator::make( $input , $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput( $input );
        }
    }

    private function saveProperty(Property $property, $input)
    {
        try{
            $property->fill( $input );
            $property->country_id = $input['country_id'];
            $property->save();
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()
                        ->withErrors(['Exception error occured'])
                        ->withInput( $input );
        }

        return redirect( route('profile.properties.edit', $property->id) )
            ->with('status', __('Property updated successfully') );
    }

    private function createProperty($input)
    {
        try{
            $property = new Property($input);
            $property->user_id = \Auth::user()->id;
            $property->country_id = $input['country_id'];
            $property->save();                
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()
                        ->withErrors(['Exception error occured'])
                        ->withInput( $input );
        }

        return redirect( route('profile.properties.edit', $property->id) )
            ->with('status', __('Property created successfully') );
    }

}
