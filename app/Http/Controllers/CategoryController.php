<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function category()
    {
        $categories = Category::all();
        return view('backend.category.category', [
            'categories' => $categories,
        ]);
    }

    function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'cat_img' => 'file|mimes:jpg,png|max:5120000|',
        ]);

        $uploaded_file = $request->cat_img;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(" ", "-", $request->category_name)) . rand(11111, 99999) . '.' . $extension;
        Image::make($uploaded_file)->save(public_path('/uploads/category/' . $file_name));


        Category::create([
            'category_name' => $request->category_name,
            'cat_img' => $file_name,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('category', 'Category has been added');
    }

    function category_edit($category_id)
    {
        $categories = Category::find($category_id);
        return view('backend.category.edit_category', [
            'categories' => $categories,
        ]);
    }

    function category_update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'cat_img' => 'file|mimes:jpg,png|max:5120000|',
        ]);

        if ($request->cat_img == null) {
            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'added_by' => Auth::id(),
            ]);

            return back()->with('category_update', 'Category has been updated );');
        }

        if ($request->cat_img != null) {

            // delete previous image
            $category_image = Category::find($request->category_id)->cat_img;
            $deleted_from = public_path('/uploads/category/' . $category_image);
            unlink($deleted_from);

            // current image
            $uploaded_file = $request->cat_img;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = rand(11111, 99999999) . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('/uploads/category/' . $file_name));

            Category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'cat_img' => $file_name,
                'added_by' => Auth::id(),
            ]);

            return back()->with('category_update', 'Category has been updated );');
        }
    }

    function category_delete($category_id)
    {
        Category::find($category_id)->delete();

        return back()->with('category_delete', 'Category has been deleted');
    }

    function trash_category()
    {
        $trashes = Category::onlyTrashed()->where("id", "!=", Auth::id())->get();
        return view("backend.category.trash_category", [
            'trashes' => $trashes,
        ]);
    }

    function category_trash_restore($category_id)
    {
        Category::onlyTrashed()->find($category_id)->restore();

        return back()->with('category_restore', 'Category has been restored');
    }

    function category_trash_delete($category_id)
    {
        $category_image = Category::onlyTrashed()->find($category_id)->cat_img;
        $deleted_from = public_path("/uploads/category/" . $category_image);
        unlink($deleted_from);

        Category::onlyTrashed()->find($category_id)->forceDelete();

        return back()->with('category_delete', 'Category has been deleted');
    }


    function sub_category()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view("backend.category.sub_category", [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function sub_category_store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required',
        ]);

        SubCategory::create([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return back()->with("subcategory", "Added Successfully");
    }

    function getsubcategory(Request $request)
    {
        $subcategories = SubCategory::where("category_id", $request->category_id)->get();

        $subcate = '';

        foreach ($subcategories as $subcategory) {
            $subcate .= '<p>' . $subcategory->subcategory_name . '</p>';
        }
        return $subcate;
    }

    function edit_subcategory($subcategory_id)
    {
        $subcategory_info = SubCategory::find($subcategory_id);
        $categories = Category::all();
        return view("backend.category.edit_subcategory", [
            'subcategory_info' => $subcategory_info,
            'categories' => $categories,
        ]);
    }

    function subcategory_update(Request $request)
    {
        SubCategory::find($request->subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
        ]);

        return back()->with("update_sub", "Updated Successfully!");
    }

    function del_subcategory($subcategory_id)
    {
        SubCategory::find($subcategory_id)->delete();
        return back()->with("sub_delete", "Deleted Successfully :)");
    }
}
