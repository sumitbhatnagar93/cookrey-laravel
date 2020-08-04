<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            return response()->json([$validator->errors()], 401);
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
            'phone' => ['required', 'integer', 'string', 'min:10', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
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

    public function update(Request $request)
    {
        $user = User::where('email',$request->get('email'))->first();
        $user->phone = $request->get('phone');
        $user->save();
        $user['token'] = $user->createToken('Cookrey')->accessToken;
        return response()->json($user, $this->successStatus);
    }

    public function socialRegister(Request $request): User
    {
        /**
         * Check if details are valid
         */
        /**
         * @var User $user
         */
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return $user;
    }
}
