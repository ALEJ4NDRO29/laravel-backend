<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Requests\API\LoginUser;
use App\Http\Requests\API\RegisterUser;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends ApiController
{

    public function __construct(UserTransformer $transformer)
    {
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

        // error_log($request);
        // error_log('Create new user');

        return $user;
    }

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) {
        $socialUser = Socialite::driver($provider)->user();

        // error_log(print_r($socialUser->getNickname(), 1));
        // error_log(print_r($socialUser, 1));
        $user = User::firstOrCreate(
            [
                'social' => $socialUser->getId()
            ],
            [
                'social' => $socialUser->getId(),
                'email' => $socialUser->getEmail(),
                'username' => $socialUser->getNickname()
            ]
        );
        Storage::disk('local')->put('file.txt',$this->respondWithTransformer($user));
        return redirect()->to('http://localhost:4200/sociallogin');
    }

    public function loginSocial(Request $request)
    {
        error_log('socialLogin');
        $exists = Storage::disk('local')->exists('file.txt');
        if($exists){
            $user = Storage::disk('local')->get('file.txt');
            Storage::disk('local')->delete('file.txt');
        }
        return explode('GMT',$user)[1];
    }
}
