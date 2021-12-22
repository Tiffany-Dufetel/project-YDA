<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Company;
use App\Models\User;
use Dotenv\Validator as DotenvValidator;
use Validator;


class AuthController extends BaseController
{

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            $success['name'] =  $auth->name;

            return $this->handleResponse($success, 'User logged-in!');
        } else {
            return $this->handleError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function register(Request $request)
    {
/*         $currentURL = url()->previous();

        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            // 'email' => 'required|email',
            // 'password' => 'required',
            // 'confirm_password' => 'required|same:password',
            // 'first_name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $input =$request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $user->name;
        event(new Registered($user));
        return $this->handleResponse($success, 'User successfully registered!'); */
    }


    public function getRole()
    {
        $userId = Auth::user();

        return $userId;
    }

    public function getUserInfo($id)
    {
        // dd('id', $id);
        return User::with('company')->where('id', $id)->get();
    }
}
