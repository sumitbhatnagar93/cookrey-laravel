<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Users extends Controller
{

    public function __construct()
    {
        $this->middleware('cors');
    }

    public function getUser($email)
    {
        $user = User::where('email', $email)->first();
        return response()->json($user, 200);
    }

    public function getUserSubscriptionById($id)
    {
        $userSubscription = DB::table('user_subscribtion')->where('userId', $id)->first();
        return response()->json($userSubscription, 200);
    }

    public function userAccount()
    {
        return view('pages/account');
    }
}
