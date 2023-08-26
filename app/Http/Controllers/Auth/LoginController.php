<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\BrowserHelpers;
use App\Helpers\IpClientHelpers;
use App\Enums\ResponseCode;
use App\Enums\Portal;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // public function formLogin()
    // {
    //     if (Session::has('name')) 
    //     {
    //         return redirect()->route('home::dashboard');
    //     } else {
    //         return view('auth.login');
    //     }
    // }
}
