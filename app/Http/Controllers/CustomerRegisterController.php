<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customerlogin;
use App\Models\CustomerMailVerify;
use App\Notifications\CustomerEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

use Illuminate\Support\Facades\Auth;

class CustomerRegisterController extends Controller
{
    function customer_register()
    {
        return view("frontend.custom.custom_registration");
    }

    function customer_login()
    {
        return view("frontend.custom.custom_login");
    }

    function register_store(CustomerRequest $request)
    {
        if ($request->password == $request->password_confirmation) {
            Customerlogin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $customer = Customerlogin::where('email', $request->email)->firstOrFail();

            $customer_info = CustomerMailVerify::create([
                'customer_id' => $customer->id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);

            Notification::send($customer, new CustomerEmailVerifyNotification($customer_info));

            return back()->with('verify', 'Please verify your email :) ');
        }

        // password not match
        else {
            return back()->with("match", "Password Not Match!");
        }
    }

    function login_store(Request $request)
    {
        if (Auth::guard("customerlogin")->attempt(['email' => $request->email, 'password' => $request->password])) {

            if (Auth::guard('customerlogin')->user()->email_verified_at == null) {
                return back()->with('mail', 'Please verify your email');
            } else {
                return redirect("/")->with("login", "Logged in successfully!");
            }
        }

        // else
        else {
            return back()->with("exist", "Email or Password Not Match");
        }
    }

    function customer_logout()
    {
        Auth::guard("customerlogin")->logout();
        return redirect("/");
    }
}
