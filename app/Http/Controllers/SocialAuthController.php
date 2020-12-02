<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function facebook_redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback()
    {
        $user = Socialite::driver('facebook')->user();
        print_r($user);
        // when facebook call us a with token
    }
    public function twitter_redirect()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function twitter_callback()
    {
        $user = Socialite::driver('twitter')->user();
        print_r($user);
        // when facebook call us a with token
    }
}
