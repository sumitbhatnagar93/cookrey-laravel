<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public $successStatus = 200;

    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $user = response()->json(['error', $validator->errors()], 401);
        } else {
            $user = $this->createUser($request);
        }
        DB::commit();

        return response()->json($user, $this->successStatus);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create new user record with profile information
     *
     * @param Request $request
     */
    public function createUser($request): User
    {
        /**
         * Check if details are valid
         */
        /**
         * @var User $user
         */
            $user = User::create([
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]);
            $user['token'] = $user->createToken('Cookrey')->accessToken;

        return $user;
    }
}
