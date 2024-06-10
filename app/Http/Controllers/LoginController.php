<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //socialLogin
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    //handleProviderCallback
    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $this->_registerOrLoginUser($userSocial);
        return redirect()->route('home');
    }


    protected function _registerOrLoginUser($data)
    {
        // dd($data);
        $user = User::where('email', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->password = bcrypt($data->name);
            $user->save();
        }
        Auth::login($user);
        try {
            $data = Support::getFromSession();
            auth()->user()->qrCodes()->create($data);
            Support::forgetFromSession();
            return $data['is_dynamic'] ? redirect()->route('my-qrcode.dynamic') : redirect()->route('my-qrcode.static');

        } catch (\Throwable $th) {
            Support::forgetFromSession();
        }
    }
}
