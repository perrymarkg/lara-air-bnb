<?php

namespace App\Http\Controllers\Profile;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    //
    
    public function index(Request $request)
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        return view('profile.edit-profile');
    }

    public function editDetails(Request $request)
    {
        return view('profile.edit-profile');
    }

    public function updateDetails(Request $request)
    {
        $fields = [
            'first_name',
            'last_name',
            'address',
            'phone'
        ];

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
        ];

        $messages = [
            'first_name.required' => 'Firstname field is required',
            'last_name.required' => 'Lastname field is required'
        ];

        $validator = Validator::make( $request->only( $fields ), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->only( $fields ));
        }

        try{
            $user = User::find(Auth::user()->id);
            $user->fill( $request->only($fields) );
            $user->save();
        } catch(\Illuminate\Database\QueryException $e) {
            // @Todo - do something here?
        }
        
        return redirect( route('profile.details.edit') )
            ->with('status', __('Details updated successfully') );
    }

    public function test(Request $request)
    {
        return view('profile.edit-profile');
    }
}
