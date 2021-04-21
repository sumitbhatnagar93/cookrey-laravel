<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserSubscription;
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
        $userSubscription = UserSubscription::where('userId', $id)->with('product')->get();
        return response()->json($userSubscription, 200);
    }

    public function getSingleSubscriptionById($userId, $subId)
    {
        $userSubscription = UserSubscription::where(['userId' => $userId, 'id' => $subId])->first();
        if ($userSubscription) {
            return response()->json($userSubscription, 200);
        } else {
            return response()->json(['invalid data'], 500);
        }
    }

    public function userAccount($slug, $subId = '')
    {
        $menu = [
            ['url' => route('account', 'profile'),
                'slug' => 'profile',
                'name' => 'Profile'],
            ['url' => route('account', 'order'),
                'slug' => 'order',
                'name' => 'Orders'],
            ['url' => route('account', ['subscription', 'all']),
                'slug' => 'subscription',
                'name' => 'Your Subscription'],
        ];
        return view('pages/account', ['slug' => $slug, 'subId' => $subId, 'menu' => $menu]);
    }

    public function getUserById($id)
    {
        $user = User::where('id', $id)->with('usersMeta')->first();
        return response()->json($user, 200);
    }
}
