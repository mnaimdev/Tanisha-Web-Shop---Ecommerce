<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store(Request $request)
    {
        if (Auth::guard("customerlogin")->check()) {


            // Cart
            if ($request->btn == 1) {

                // size id
                if ($request->size_id == "") {
                    $size_id = 1;
                } else {
                    $size_id = $request->size_id;
                }

                // color id
                if ($request->color_id == "") {
                    $color_id = 1;
                } else {
                    $color_id = $request->color_id;
                }

                $quantity = Inventory::where("product_id", $request->product_id)->where("color_id", $color_id)->where("size_id", $size_id)->first()->quantity;

                if ($request->quantity > $quantity) {
                    return back()->with("stock", "Total Stock : " . $quantity);
                } else {
                    Cart::create([
                        'product_id' => $request->product_id,
                        'customer_id' => Auth::guard("customerlogin")->id(),
                        'color_id' => $color_id,
                        'size_id' => $size_id,
                        'quantity' => $request->quantity,
                    ]);
                }

                return back()->with("cart_add", "Card Added Successfully:) ");
            }



            // Wishlist
            else {

                if ($request->size_id == "") {
                    $size_id = 1;
                } else {
                    $size_id = $request->size_id;
                }

                // color id
                if ($request->color_id == "") {
                    $color_id = 1;
                } else {
                    $color_id = $request->color_id;
                }

                Wishlist::create([
                    'product_id' => $request->product_id,
                    'customer_id' => Auth::guard("customerlogin")->id(),
                    'color_id' => $color_id,
                    'size_id' => $size_id,
                    'quantity' => $request->quantity,
                ]);

                return back()->with("wish", "Product added to wishlist :) ");
            }
        }


        // redirect to login
        else {
            return redirect()->route("customer.login")->with("cart", "You need login for adding product");
        }
    }



    function cart_remove($cart_id)
    {
        Cart::find($cart_id)->delete();
        return back();
    }

    function cart_clear()
    {
        Cart::where("customer_id", Auth::guard("customerlogin")->id())->delete();
        return back();
    }

    function cart(Request $request)
    {
        $carts = Cart::where("customer_id", Auth::guard("customerlogin")->id())->get();

        $discount = 0;
        $message = "";
        $type = "";

        if ($request->coupon_code == "") {
            $message = "";
            $discount = 0;
        } else {
            if (Coupon::where("coupon_code", $request->coupon_code)->exists()) {
                if (Carbon::now()->format("Y-m-d") < Coupon::where("coupon_code", $request->coupon_code)->first()->validity) {
                    $discount = Coupon::where("coupon_code", $request->coupon_code)->first()->discount_amount;
                    $type = Coupon::where("coupon_code", $request->coupon_code)->first()->type;
                    $message = "Coupon Code Applied!";
                } else {
                    $message = "Coupon Code Expired";
                    $discount = 0;
                }
            } else {
                $message = "Invalid Coupon Code";
                $discount = 0;
            }
        }



        return view("frontend.cart.cart", [
            'carts' => $carts,
            'message' => $message,
            'discount' => $discount,
            'type' => $type,
        ]);
    }

    function cart_update(Request $request)
    {
        foreach ($request->quantity as $size_id => $quantity) {
            Cart::find($size_id)->update([
                'quantity' => $quantity,
            ]);
        }
        return back()->with("cart_update", "Cart Updated!");
    }
}
