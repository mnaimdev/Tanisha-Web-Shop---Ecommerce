<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    function wishlist()
    {
        $wishlists = Wishlist::where("customer_id", Auth::guard("customerlogin")->id())->get();
        return view("frontend.wishlist.wishlist", [
            'wishlists' => $wishlists,
        ]);
    }

    function wishlist_remove($wishlist_id)
    {
        Wishlist::find($wishlist_id)->delete();
        return back();
    }
}
