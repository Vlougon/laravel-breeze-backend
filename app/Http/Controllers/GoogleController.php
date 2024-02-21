<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::UpdateOrCreate(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name ? $googleUser->name : 'Anon Google',
                'email' => $googleUser->email,
                'role' => 'assistant',
                'password' => 'Holas_12345.Admin',
                'google_id' => $googleUser->id,
            ]
        );

        Auth::login($user);

        return redirect('http://localhost:3000/login');
    }
}
