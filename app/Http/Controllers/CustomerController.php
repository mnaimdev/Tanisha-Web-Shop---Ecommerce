<?php

namespace App\Http\Controllers;

use App\Models\Customerlogin;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}
