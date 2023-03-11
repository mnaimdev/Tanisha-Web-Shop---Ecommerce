<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customerlogin;
use Illuminate\Http\Request;
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

            if (Auth::guard("customerlogin")->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect("/")->with("login", "Logged in successfully!");
            }

            // return back()->with("register", "Registered Successfully");
        } else {
            return back()->with("match", "Password Not Match!");
        }
    }

    function login_store(Request $request)
    {
        if (Auth::guard("customerlogin")->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect("/")->with("login", "Logged in successfully!");
        } else {
            return back()->with("exist", "Email or Password Not Match");
        }
    }

    function customer_logout()
    {
        Auth::guard("customerlogin")->logout();
        return redirect("/");
    }
}
