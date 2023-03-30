<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use App\Models\CustomerMailVerify;
use App\Models\CustomerPassReset;
use App\Models\Orders;
use App\Notifications\CustomerPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Image;

class CustomerController extends Controller
{
    function customer_profile()
    {
        return view("frontend.custom.customer_profile");
    }

    function profile_update(Request $request)
    {
        if ($request->new_pass == '') {

            if ($request->photo == '') {
                Customerlogin::find(Auth::guard("customerlogin")->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'address' => $request->address,
                ]);
            }

            // photo not empty
            else {

                if (Auth::guard("customerlogin")->user()->photo != null) {
                    $profile_img = Auth::guard("customerlogin")->user()->photo;
                    $deleted_from = public_path('/uploads/customer/' . $profile_img);
                    unlink($deleted_from);
                }

                $uploaded_file = $request->photo;
                $extension = $uploaded_file->getClientOriginalExtension();
                $file_name = Auth::guard("customerlogin")->id() . "." . $extension;
                Image::make($uploaded_file)->save(public_path('/uploads/customer/' . $file_name));

                Customerlogin::find(Auth::guard("customerlogin")->id())->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'address' => $request->address,
                    'photo' => $file_name,
                ]);
            }
        }


        // password not empty
        else {

            if (Hash::check($request->old_pass, Auth::guard("customerlogin")->user()->password)) {

                if ($request->photo == '') {
                    Customerlogin::find(Auth::guard("customerlogin")->id())->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'country' => $request->country,
                        'address' => $request->address,
                        'password' => bcrypt($request->new_pass),
                    ]);
                } else {

                    if (Auth::guard("customerlogin")->user()->photo != null) {
                        $profile_img = Auth::guard("customerlogin")->user()->photo;
                        $deleted_from = public_path('/uploads/customer/' . $profile_img);
                        unlink($deleted_from);
                    }

                    $uploaded_file = $request->photo;
                    $extension = $uploaded_file->getClientOriginalExtension();
                    $file_name = Auth::guard("customerlogin")->id() . "." . $extension;
                    Image::make($uploaded_file)->save(public_path('/uploads/customer/' . $file_name));

                    Customerlogin::find(Auth::guard("customerlogin")->id())->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'country' => $request->country,
                        'address' => $request->address,
                        'password' => bcrypt($request->new_pass),
                        'photo' => $file_name,
                    ]);
                }
            }

            //
            else {
                return back()->with("pass", "Old Password Not Match!");
            }
        }
    }

    function customer_order()
    {
        $orders = Orders::where("customer_id", Auth::guard("customerlogin")->id())->get();

        return view('frontend.custom.customer_order', [
            'orders' => $orders,
        ]);
    }


    // Forget Password
    function forget_password()
    {
        return view('frontend.pass_reset.forget_password');
    }

    function customer_pass_reset_req(Request $request)
    {
        $customer_info = Customerlogin::where('email', $request->email)->firstOrFail();
        $customer_id = $customer_info->id;

        CustomerPassReset::where('customer_id', $customer_id)->delete();

        $customer_info_inserted = CustomerPassReset::create([
            'customer_id' => $customer_id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        Notification::send($customer_info, new CustomerPassResetNotification($customer_info_inserted));


        return back()->with('notif', 'We have sent you a notification to reset your password');
    }

    function customer_pass_reset_form($token)
    {
        return view('frontend.pass_reset.pass_reset_form', [
            'token' => $token,
        ]);
    }

    function customer_pass_reset(Request $request)
    {
        if ($request->password == $request->password_confirmation) {

            $customer = CustomerPassReset::where('token', $request->token)->firstOrFail();

            Customerlogin::find($customer->customer_id)->update([
                'password' => Hash::make($request->password),
            ]);

            CustomerPassReset::where('token', $request->token)->delete();

            return redirect()->route('customer.login')->with('reset', 'You have successfully reset your password. Now you can login with your new password');
        } else {
            return back()->with('not_match', 'Password not match!');
        }
    }


    // Email Verify
    function customer_email_verify($token)
    {
        $customer = CustomerMailVerify::where('token', $token)->firstOrFail();
        $customer_id = $customer->customer_id;

        Customerlogin::find($customer_id)->update([
            'email_verified_at' => Carbon::now()->format('d-m-Y'),
        ]);

        CustomerMailVerify::where('token', $token)->delete();

        return redirect()->route('customer.login')->with('email_verify', 'You have verified your email successfully! Now you can login without any problem');
    }
}
