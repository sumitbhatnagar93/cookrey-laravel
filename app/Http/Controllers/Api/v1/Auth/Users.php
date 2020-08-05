<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class Users extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getUser($email)
    {
        $user = User::where('email', $email)->first();
        return response()->json($user, 200);
    }
}
