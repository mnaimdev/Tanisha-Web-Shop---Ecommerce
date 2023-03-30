<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\OrderProducts;
use App\Models\Orders;
use App\Models\Stripeorder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Stripe;
use Str;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        $data = session('data');
        $total_pay = $data['sub_total'] + $data['charge'] - $data['discount'];

        $stripe_id = Stripeorder::insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'company' => $data['company'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'zip' => $data['zip'],
            'notes' => $data['notes'],
            'payment_method' => $data['payment_method'],
            'sub_total' => $data['sub_total'],
            'charge' => $data['charge'],
            'discount' => $data['discount'],
            'total' => $total_pay,
            'customer_id' => $data['customer_id'],
            'created_at' => Carbon::now(),
        ]);

        return view('frontend.stripe', [
            'data' => $data,
            'stripe_id' => $stripe_id,
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe_post(Request $request)
    {
        $order_data = Stripeorder::find($request->stripe_id);

        $order_id =  '#' . Str::upper(Str::random(3)) . '-' . rand(999954999, 1000067000);
        $total = $order_data->sub_total - $order_data->discount + $order_data->charge;



        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "BDT",
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');



        Orders::create([
            'order_id' => $order_id,
            'customer_id' => $order_data->customer_id,
            'payment_method' => $order_data->payment_method,
            'sub_total' => $order_data->sub_total,
            'discount' => $order_data->discount,
            'charge' => $order_data->charge,
            'total' => $total,
            'created_at' => Carbon::now(),
        ]);

        BillingDetails::create([
            'order_id' => $order_id,
            'customer_id' => $order_data->customer_id,
            'name' => $order_data->name,
            'email' => $order_data->email,
            'phone' => $order_data->phone,
            'company' => $order_data->company,
            'address' => $order_data->address,
            'zip' => $order_data->zip,
            'notes' => $order_data->notes,
            'country_id' => $order_data->country_id,
            'city_id' => $order_data->city_id,
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::where("customer_id", $order_data->customer_id)->get();

        foreach ($carts as $cart) {
            OrderProducts::create([
                'order_id' => $order_id,
                'customer_id' =>  $order_data->customer_id,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'price' => $total,
                'created_at' => Carbon::now(),
            ]);


            Inventory::where("product_id", $cart->product_id)->where("size_id", $cart->size_id)->where("color_id", $cart->color_id)->decrement('quantity', $cart->quantity);
        }

        Mail::to($order_data->email)->send(new InvoiceMail($order_id));

        Cart::where("customer_id", $order_data->customer_id)->delete();

        return redirect()->route("order.complete")->with("order", $order_id);
    }
}
