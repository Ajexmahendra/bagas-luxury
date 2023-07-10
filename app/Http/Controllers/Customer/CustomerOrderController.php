<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Auth;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('reviews')->where('customer_id', Auth::guard('customer')->user()->id)->orderBy('created_at', 'desc')->get();
        // dd($orders);
        return view('customer.orders', compact('orders'));
    }

    public function invoice($id)
    {
        $order = Order::where('id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $id)->get();
        return view('customer.invoice', compact('order', 'order_detail'));
    }

    public function review($id)
    {
        $orders = Order::find($id);
        // dd($orders);
        return view('customer.review', compact('orders'));
    }
    public function review_post(Request $request, $id)
    {
        $this->validate($request, [
            'rating' => 'required',
            'review' => 'required'
        ]);

        $customerId = Auth::guard('customer')->user()->id;
        $ordersId = Order::where('id', $id)->first()->id;
        // dd($orders);
        $data = new Review();
        $data->customer_id = $customerId;
        $data->order_id = $ordersId;
        $data->rating = $request->rating;
        $data->review = $request->review;
        $data->save();
        return redirect()->route('customer_order_view')->with('success', 'review Berhasil Dikirim');
    }
}
