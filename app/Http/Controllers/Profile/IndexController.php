<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        
        return view('profile.index', ['data' => $user]);
    }
}
