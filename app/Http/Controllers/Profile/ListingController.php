<?php

namespace App\Http\Controllers\Profile;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Country;

class ListingController extends Controller
{
    //

    public function index()
    {
        $data['listings'] = Listing::where('user_id', \Auth::user()->id)->get();        
        return view('profile.listings', $data);
    }

    public function create()
    {
        if( \Auth::user()->can('notCreate') ){
            return redirect( route('profile.listings.index') )
                ->withErrors(['Invalid access']);
        }

        $data['listing'] = new Listing();
        $data['submit_url'] = route('profile.listings.store');
        $data['mode'] = 'create';
        return view('profile.edit-listing', $data);
    }

    public function show(Listing $listing)
    {
        return redirect( route('profile.listings.edit', $listing->id) );
    }

    public function edit(Listing $listing)
    {
        if( !\Auth::user()->can('access', $listing) ){
            return redirect( route('profile.listings.index') )
                ->withErrors(['Invalid access']);
        }
            
        $data['listing'] = $listing;
        $data['submit_url'] = route('profile.listings.update', $listing->id);
        $data['mode'] = 'edit';
        return view('profile.edit-listing', $data);
    }

    public function update(Request $request, $id)
    {
        $listing = Listing::find($id);

        if( !\Auth::user()->can('access', $listing) ){
            return redirect( route('profile.listings.index') )
                ->withErrors(['Invalid access']);
        }

        $input = $this->requestCleanInput($request);

        $result = $this->validateForm($input);
        if( $result ){
            return $result;
        }

        return $this->saveListing($listing, $id);
    }

    public function store(Request $request)
    {
        if( \Auth::user()->can('notCreate') ){
            return redirect( route('profile.listings.index') )
                ->withErrors(['Invalid access']);
        }

        $input = $this->requestCleanInput($request);

        $result = $this->validateForm($input);
        if( $result ){
            return $result;
        }

        return $this->createListing($input);
    }

    public function destroy($id)
    {
        $listing = Listing::find($id);
        
        if( !\Auth::user()->can('access', $listing) ){
            return redirect( route('profile.listings.index') )
                ->withErrors(['Invalid access']);
        }

        $listing->delete();

        return redirect( route('profile.listings.index') )
            ->with('status', __('Listing deleted successfully') );
    }

    private function requestCleanInput(Request $request)
    {
        $fields = [
            'title', 'address','phone', 'country_id',
            'price', 'type', 'max_kids', 'max_adults',
            'bedrooms', 'beds', 'baths', 'description',
            'rules', 'cancellation'
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
            'address' => 'required'
        ];

        $messages = [
            'country_id.required' => 'Country field is required'
        ];

        $validator = Validator::make( $input , $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput( $input );
        }
    }

    private function saveListing(Listing $listing, $id)
    {
        try{
            $listing->fill( $input );
            $listing->country_id = $input['country_id'];
            $listing->save();
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()
                        ->withErrors(['Exception error occured'])
                        ->withInput( $input );
        }

        return redirect( route('profile.listings.edit', $id) )
            ->with('status', __('Listing updated successfully') );
    }

    private function createListing($input)
    {
        try{
            $listing = new Listing($input);
            $listing->user_id = \Auth::user()->id;
            $listing->country_id = $input['country_id'];
            $listing->save();                
        } catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()
                        ->withErrors(['Exception error occured'])
                        ->withInput( $input );
        }

        return redirect( route('profile.listings.edit', $listing->id) )
            ->with('status', __('Listing created successfully') );
    }

}