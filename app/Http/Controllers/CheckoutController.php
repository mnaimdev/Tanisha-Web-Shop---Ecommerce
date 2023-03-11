<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\OrderProducts;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{
    function checkout()
    {
        $carts = Cart::where("customer_id", Auth::guard("customerlogin")->id())->get();
        $countries = Country::all();

        return view("frontend.checkout.checkout", [
            'carts' => $carts,
            'countries' => $countries,
        ]);
    }

    function getCity(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        $str = '<option>-- Select City --</option>';

        foreach ($cities as $city) {
            $str .= '<option value=" ' . $city->id . ' ">' . $city->name . '</option>';
        }
        echo $str;
    }

    function order_store(Request $request)
    {
        if ($request->payment_method == 1) {

            $order_id =  '#' . Str::upper(Str::random(3)) . '-' . rand(999954999, 1000067000);
            $total = $request->sub_total - $request->discount + $request->charge;

            Orders::create([
                'order_id' => $order_id,
                'customer_id' => Auth::guard("customerlogin")->id(),
                'payment_method' => $request->payment_method,
                'sub_total' => $request->sub_total,
                'discount' => $request->discount,
                'charge' => $request->charge,
                'total' => $total,
                'created_at' => Carbon::now(),
            ]);

            BillingDetails::create([
                'order_id' => $order_id,
                'customer_id' => Auth::guard("customerlogin")->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'address' => $request->address,
                'zip' => $request->zip,
                'notes' => $request->notes,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'created_at' => Carbon::now(),
            ]);

            $carts = Cart::where("customer_id", Auth::guard("customerlogin")->id())->get();

            foreach ($carts as $cart) {
                OrderProducts::create([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard("customerlogin")->id(),
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'price' => $total,
                    'created_at' => Carbon::now(),
                ]);


                Inventory::where("product_id", $cart->product_id)->where("size_id", $cart->size_id)->where("color_id", $cart->color_id)->decrement('quantity', $cart->quantity);
            }

            Mail::to($request->email)->send(new InvoiceMail($order_id));

            Cart::where("customer_id", Auth::guard("customerlogin")->id())->delete();

            return redirect()->route("order.complete")->with("order", $order_id);
        }



        // payment method 2
        else if ($request->payment_method == 2) {
            $data = $request->all();
            return redirect()->route('pay')->with('data', $data);
        }

        // payment method 3
        else {
            echo "Stripe";
        }
    }

    function order_complete()
    {

        $order_id = session("order_id");

        if (session("order")) {
            return view("frontend.order_complete", [
                'order_id' => $order_id,
            ]);
        } else {
            return redirect("/");
        }
    }
}
