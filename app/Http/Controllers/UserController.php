<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
//use Laravel\Socialite\Contracts\Factory as Socialite; //Socialize::
use Illuminate\Contracts\Auth\Authenticator;
use Socialize;
//use Symfony\Component\HttpFoundation\Request; //::segment()

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('member');
    }

    // public function home(){
    // 	$userLocal = Auth::user();
    // 	return view ('pages.user.home', compact('userLocal'));
    // }
    // public function logout(){
    // 	Auth::logout();
    // 	return redirect ('index');
    // }

    
}
