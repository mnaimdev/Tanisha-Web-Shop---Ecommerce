<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Size;
use Illuminate\Http\Request;
use Cookie;
use Arr;

class FrontendController extends Controller
{
    function frontend()
    {
        $categories = Category::all();
        $products = Product::latest('created_at')->get();
        $feat_products = Product::latest()->take(3)->get();



        $top_selling_products = OrderProducts::groupBy('product_id')
            ->selectRaw('product_id, sum(quantity) as total')
            ->orderBy('total', 'DESC')
            ->get();

        //  Cookies

        $recent = json_decode(Cookie::get('recent'), true);

        if ($recent == null) {
            $recent = [];
            $after_unique = array_unique($recent);
        } else {
            $after_unique = array_unique($recent);
        }

        $recent_viewed_products = Product::find($after_unique);

        return view("frontend.index", [
            'categories' => $categories,
            'products' => $products,
            'feat_products' => $feat_products,
            'top_selling_products' => $top_selling_products,
            'recent_viewed_products' => $recent_viewed_products,
        ]);
    }

    function product_details($slug)
    {
        $product_info = Product::where("slug", $slug)->first();
        $related_products = Product::where("category_id", $product_info->category_id)->where("id", "!=", $product_info->id)->get();
        $product_thumbnails = ProductThumbnail::where("product_id", $product_info->id)->get();
        $sizes = Size::all();

        // color, size
        $available_colors = Inventory::where("product_id", $product_info->id)
            ->groupBy("color_id")
            ->selectRaw("count(*) as total, color_id")
            ->get();

        $available_size = Inventory::where("product_id", $product_info->id)->first()->size_id;

        // reviews
        $reviews = OrderProducts::where('product_id', $product_info->id)->where('review', '!=', null)->get();
        $total_reviews = OrderProducts::where('product_id', $product_info->id)->where('review', '!=', null)->count();
        $total_stars = OrderProducts::where('product_id', $product_info->id)->where('review', '!=', null)->sum('star');

        // Cookies

        $product_id = $product_info->id;

        $al = Cookie::get('recent');

        if ($al == null) {
            $al = "[]";
        }

        $all_info = json_decode($al, true);
        $new_info = Arr::prepend($all_info, $product_id);
        $recent_product_id = json_encode($new_info);

        Cookie::queue('recent', $recent_product_id, 1000);



        return view("frontend.product.product_details", [
            'product_info' => $product_info,
            'related_products' => $related_products,
            'product_thumbnails' => $product_thumbnails,
            'available_colors' => $available_colors,
            'sizes' => $sizes,
            'available_size' => $available_size,
            'reviews' => $reviews,
            'total_reviews' => $total_reviews,
            'total_stars' => $total_stars,
        ]);
    }

    function getSize(Request $request)
    {
        $sizes = Inventory::where("product_id", $request->product_id)->where("color_id", $request->color_id)->get();

        $str = '';
        foreach ($sizes as $size) {
            $str .= '
            <div class="form-check size-option form-option              form-check-inline mb-2">
                    <input class="form-check-input" type="radio" name="size_id"
                    value="' . $size->rel_to_size->id . '"
                        id="' . $size->rel_to_size->id . '">
                    <label class="form-option-label"
                        for="' . $size->rel_to_size->id . '">' . $size->rel_to_size->size_name . ' </label>
            </div>';
        }
        echo $str;
    }


    function category_product($category_id)
    {
        $category_info = Category::find($category_id);
        $products = Product::where('category_id', $category_id)->get();
        return view('frontend.category_product', [
            'category_info' => $category_info,
            'products' => $products,
        ]);
    }
}
