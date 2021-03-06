<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirecTo = '/test';
    }

    /**
     * Get the needed authorization credentials from the request and check if email or username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password
        ];
    }

    protected function attemptLogin(Request $request)
    {
        
        if( !$this->validateNotAdmin($request) ) {
            return false;
        }
        
        return $this->guard()->attempt(
            $this->credentials($request), 
            $request->filled('remember')
        );
    }

    protected function validateNotAdmin(Request $request)
    {
        $creds = $this->credentials($request);
        $keys = array_keys($creds);
        try{
            $conditions = [
                [$keys[0], '=', $creds[$keys[0]] ],
                ['user_type', '!=', 'admin']
            ];
            
            User::where($conditions)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }

        return true;
    }
    
    protected function redirectTo()
    {
        return '/';
    }

    
}
