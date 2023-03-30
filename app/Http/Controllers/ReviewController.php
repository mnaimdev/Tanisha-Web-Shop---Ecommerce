<?php

namespace App\Http\Controllers;

use App\Models\OrderProducts;
use Illuminate\Http\Request;
use Image;

class ReviewController extends Controller
{
    function review_store(Request $request)
    {
        if ($request->image == '') {
            OrderProducts::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update([
                'review' => $request->review,
                'star' => $request->star,
            ]);

            return back();
        }

        // else
        else {

            $uploaded_file = $request->image;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = $request->customer_id . "." . $extension;

            Image::make($uploaded_file)->save(public_path('/uploads/review/' . $file_name));

            OrderProducts::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->update([
                'review' => $request->review,
                'star' => $request->star,
                'image' => $file_name,
            ]);

            return back();
        }
    }
}
