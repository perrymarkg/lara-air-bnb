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

        $result = $this->validateForm( $request->only($fields), $rules, $messages );
        if( $result ) return $result;

        $this->updateUser( $request->only($fields) );
        
        return redirect( route('profile.details.edit') )
            ->with('status', __('Details updated successfully') );
    }

    public function editAccount(Request $request)
    {
        return view('profile.edit-account');
    }

    public function updateAccount(Request $request)
    {
        $fields = [
            'username',
            'email',
        ];

        $rules = [
            'username' => 'required|min:5|max:10',
            'email' => 'required|email',
        ];

        $messages = [
            'username.required' => 'Username field is required',
            'username.min' => 'Username is too short, please use atleast 5 characters',
            'username.max' => 'Username is too long, please use no more than 10 characters',
            'email.required' => 'Email field is required',
            'email.email' => 'Please provide a valid email'
        ];

        $result = $this->validateForm( $request->only($fields), $rules, $messages );
        if( $result ) return $result;

        $result = $this->updateUser( $request->only($fields) );
        if($result) {
            return redirect( route('profile.account.edit') )
            ->withErrors($result);
        }

        return redirect( route('profile.account.edit') )
            ->with('status', __('Account updated successfully') );
    }

    private function validateForm($input, $rules, $messages = null)
    {
        $validator = Validator::make( $input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($input);
        }
    }

    private function updateUser( $input )
    {
        try{
            $user = User::find(Auth::user()->id);
            $user->fill( $input );
            $user->save();
        } catch(\Illuminate\Database\QueryException $e) {
            // @Todo - do something here?
            $errors = [];
            if( preg_match( '/Integrity constraint violation: 1062 Duplicate entry/', $e->getMessage() ) ){
                if( preg_match('/username_unique/', $e->getMessage() ) )
                    $errors[] = 'Username "'. $input['username'].'" is already taken';
            }
            return $errors;
        }
    }

    private function processForm()
    {

    }
    
}
