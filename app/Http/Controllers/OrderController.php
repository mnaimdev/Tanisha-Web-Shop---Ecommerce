<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\OrderProducts;
use App\Models\Orders;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    function orders()
    {
        $orders = Orders::all();
        return view('backend.order.order', [
            'orders' => $orders,
        ]);
    }

    function order_status(Request $request)
    {
        $after_explode = explode(",", $request->status);
        $order_id =  $after_explode[0];
        $status =  $after_explode[1];

        Orders::where("order_id", $order_id)->update([
            'status' => $status,
        ]);

        return back();
    }

    function invoice_download($id)
    {
        $order_info = Orders::find($id);
        $order_id = $order_info->order_id;

        $order_products = OrderProducts::where("order_id", $order_id)->get();
        $billing_details = BillingDetails::where("order_id", $order_id)->get();

        $pdf = PDF::loadView('invoice.download', [
            'order_id' => $order_id,
            'billing_details' => $billing_details,
            'order_products' => $order_products,
        ]);

        return $pdf->download('invoice.pdf');
    }
}
