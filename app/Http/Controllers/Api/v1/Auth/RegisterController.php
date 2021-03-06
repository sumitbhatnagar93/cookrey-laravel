<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserMeta;
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
        $user = User::where('email', $request->get('email'))->first();
        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->save();
        $user['token'] = $user->createToken('Cookrey')->accessToken;
        return response()->json($user, $this->successStatus);
    }

    public function updateImage(Request $request)
    {
        $data = $request->all();
        $uploadPath = public_path('/images/profile/');
        $user = User::where('email', $request->get('email'))->first();
        if ($user) {
            if ($request->hasFile('picture')) {
                if ($request->get('old_picture') && !filter_var($request->get('old_picture'), FILTER_VALIDATE_URL)) {
                    if ($this->does_url_exists($request->get('old_picture'))) {
                        unlink($uploadPath . '/' . $request->get('old_picture'));
                    }
                }
                $file = $request->file('picture');
                $filename = $file->getClientOriginalName();
                $picture = $filename;
                $file->move($uploadPath, $picture);
                $data['picture'] = $picture;
                $user->picture = $data['picture'];
                $user->save();
                $user['token'] = $user->createToken('Cookrey')->accessToken;
                return response()->json($user, $this->successStatus);
            } else {
                //  $data['picture'] = $request->get('old_picture');
                return response()->json('no image found', $this->successStatus);
            }

        }

    }

    public function socialRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'picture' => $request->get('picture'),
        ]);

        return response()->json($request);
    }

    public function does_url_exists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }


    public function updateUser(Request $request)
    {
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        $user->phone = $data['phone'];
        if ($user->save()){
            $userMeta  = UserMeta::where('user_email', $data['email'])->first();
            $userMeta->firstName = $data['users_meta']['firstName'];
            $userMeta->lastName = $data['users_meta']['lastName'];
            $userMeta->address = $data['users_meta']['address'];
            $userMeta->save();
            return response()->json(['message'=>'Account has been updated!','type'=>'success']);
        }else{
            return response()->json(['message'=>'Something went wrong!','type'=>'error']);
        }
    }
}
