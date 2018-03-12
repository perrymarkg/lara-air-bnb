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
        $data['listing'] = $listing;
        $data['submit_url'] = route('profile.listings.update', $listing->id);
        $data['mode'] = 'edit';
        return view('profile.edit-listing', $data);
    }

    public function update(Request $request, $id)
    {
        // @Todo check if user can edit listing

        $fields = [
            'title', 'address','phone', 'country',
            'price', 'type', 'max_kids', 'max_adults',
            'bedrooms', 'beds', 'baths', 'description',
            'rules', 'cancellation'
        ];

        $rules = [
            'title' => 'required|max:255',
            'country' => 'required',
            'type' => 'required',
            'price' => 'regex:/^\d*(\.\d{1,2})?$/|required|min:0'
        ];



        $validator = Validator::make( $request->only( $fields ), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->only( $fields ));
        }

        try{
            unset( $fields['country'] );
            
            $listing = Listing::find($id);
            $listing->fill( $request->only($fields) );
            $listing->country_id = $request->country;
            $listing->save();
        } catch(\Illuminate\Database\QueryException $e) {
            echo $e->getMessage();
        }

        return redirect( route('profile.listings.edit', $id) )
            ->with('status', __('Listing updated successfully') );
    }

    private function validateForm( $fields, $rules, $messages = null)
    {

    }

}
