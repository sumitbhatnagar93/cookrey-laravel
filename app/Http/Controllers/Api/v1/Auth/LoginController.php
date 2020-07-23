<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        /**
         * @var User $user
         */
        $user = User::where('phone', request('username'))->first();
        if ($user) {
            if (Auth::attempt(['phone' => request('username'), 'password' => request('password')])) {
                $user = Auth::user();
                $user['token'] = $user->createToken('Cookrey')->accessToken;
                $user = response()->json($user, 200);
            } else {
                $user = response()->json(['error' => 'Invalid Password', 'errorType' => 'password'], 401);
            }
        } else {
            $user = response()->json(['error' => 'Invalid User', 'errorType' => 'phone'], 401);
        }
        return $user;
    }
}
