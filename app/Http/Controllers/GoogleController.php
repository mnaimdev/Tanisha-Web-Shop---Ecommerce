<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    function github_callback()
    {
        $user = Socialite::driver('google')->user();

        if (Customerlogin::where('email', $user->getEmail())->exists()) {
            if (Auth::guard("customerlogin")->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
                return redirect('/');
            }
        }

        // else
        else {

            Customerlogin::insert([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc@123'),
            ]);

            if (Auth::guard("customerlogin")->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])) {
                return redirect('/');
            }
        }
    }
}
