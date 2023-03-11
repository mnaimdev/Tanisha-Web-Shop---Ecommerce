<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductThumbnail;
use App\Models\Size;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Image;


class ProductController extends Controller
{
    // Product

    function product()
    {
        $categories = Category::all();
        return view("backend.product.product", [
            'categories' => $categories,
        ]);
    }

    function getsubcategory(Request $request)
    {
        $subcategories = SubCategory::where("category_id", $request->category_id)->get();

        $str = '<option>-- Select Subcategory --</option>';

        foreach ($subcategories as $subcategory) {
            $str .= '<option value=" ' . $subcategory->id . ' " >' . $subcategory->subcategory_name . '</option>';
        }

        echo $str;
    }

    function product_store(Request $request)
    {

        $slug = Str::lower(str_replace(" ", "-", $request->product_name)) . "-" . rand(1000000, 9999999999);

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'brand' => $request->brand,
            'discount' => $request->discount,
            'after_discount' => $request->price - ($request->price * 10) / 100,
            'slug' => $slug,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'created_at' => Carbon::now(),
        ]);

        $uploaded_file = $request->preview;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(" ", "-", $request->product_name)) . "." . $extension;

        Image::make($uploaded_file)->save(public_path("/uploads/product/preview/" . $file_name));

        Product::find($product_id)->update([
            'preview' => $file_name,
        ]);

        // Thumbail process
        $uploaded_thumb = $request->thumbnails;

        if ($request->thumbnails != null) {
            foreach ($uploaded_thumb as $thumbnail) {
                $extension = $thumbnail->getClientOriginalExtension();
                $thumb_name = Str::lower(str_replace(" ", "-", $request->product_name)) . rand(1000000, 99999999) . "." . $extension;

                Image::make($thumbnail)->save(public_path("/uploads/product/thumbnail/" . $thumb_name));

                ProductThumbnail::create([
                    'product_id' => $product_id,
                    'product_thumbnail' => $thumb_name,
                ]);
            }
        }

        return back()->with("product", "Product Added!");
    }

    function product_list()
    {
        $products = Product::all();
        return view("backend.product.product_list", [
            "products" => $products,
        ]);
    }

    function product_delete($product_id)
    {
        // preview delete
        $preview_img = Product::find($product_id)->preview;
        $deleted_from = public_path("/uploads/product/preview/" . $preview_img);
        unlink($deleted_from);

        // thumbnail delete
        $product_thumbs =  ProductThumbnail::where('product_id', $product_id)->get();

        foreach ($product_thumbs as $thumb) {
            $deleted_from = public_path("/uploads/product/thumbnail/" . $thumb->product_thumbnail);
            unlink($deleted_from);

            ProductThumbnail::find($thumb->id)->delete();
        }

        // Inventory
        $product_inventories = Inventory::where("product_id", $product_id)->get();
        foreach ($product_inventories as $inventory) {
            Inventory::find($inventory->id)->delete();
        }

        // product delete
        Product::find($product_id)->delete();

        return back()->with("product_delete", "Product Deleted");
    }

    // Product Variation

    function product_variation()
    {
        $colors = Color::all();
        $sizes = Size::all();
        return view("backend.product.product_variation", [
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    function color_store(Request $request)
    {
        $request->validate([
            'color_name' => 'required',
        ]);

        Color::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);

        return back()->with("color", "Color Added :)");
    }

    function size_store(Request $request)
    {
        $request->validate([
            'size_name' => 'required',
        ]);

        Size::create([
            'size_name' => $request->size_name,
        ]);

        return back()->with("size", "Size Added :)");
    }

    function color_delete($color_id)
    {
        Color::find($color_id)->delete();

        return back()->with("color_delete", "Deleted Successfully :) ");
    }

    function size_delete($size_id)
    {
        Size::find($size_id)->delete();

        return back()->with("size_delete", "Deleted Successfully :) ");
    }

    // Product Inventory

    function product_inventory($product_id)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $product_info = Product::find($product_id);
        $inventories = Inventory::where("product_id", $product_id)->get();

        return view("backend.product.inventory", [
            'colors' => $colors,
            'sizes' => $sizes,
            'product_info' => $product_info,
            'inventories' => $inventories,
        ]);
    }

    function inventory_store(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
        ]);

        if (Inventory::where("product_id", $request->product_id)->where("color_id", $request->color_id)->where("size_id", $request->size_id)->exists()) {

            Inventory::where("product_id", $request->product_id)->where("color_id", $request->color_id)->where("size_id", $request->size_id)->increment('quantity', $request->quantity);

            return back()->with("inventory", "Inventory added of this product");
        } else {
            Inventory::create([
                'product_id' => $request->product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);

            return back()->with("inventory", "Inventory added of this product");
        }
    }

    function del_inventory($inventory_id)
    {
        Inventory::find($inventory_id)->delete();

        return back()->with("del_inventory", "Deleted Successfully :)");
    }
}
