<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Requests\API\LoginUser;
use App\Http\Requests\API\RegisterUser;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{

    public function __construct(UserTransformer $transformer)
    // public function __construct($a)
    {
        // error_log(print_r($transformer, 1));
        $this->transformer = $transformer;   
    }

    public function login(LoginUser $request)
    {
        $credentials = $request->only('user.username', 'user.password');
        $credentials = $credentials['user'];

        if (!Auth::once($credentials)) {
            return $this->reapondsUnauthorized();
        }

        return $this->respondWithTransformer(auth()->user());
        // return auth()->user();
    }

    public function register(RegisterUser $request)
    {
        $user = User::create([
            'username' => $request->input('user.username'),
            'email' => $request->input('user.email'),
            'password' => $request->input('user.password')
        ]);

        error_log($request);
        error_log('Create new user');
        
        return $user;
    }
}
