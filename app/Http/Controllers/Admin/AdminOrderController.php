<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetail')->orderBy('created_at', 'desc')->get();
        // dd($orders);
        return view('admin.orders', compact('orders'));
    }

    public function invoice($id)
    {
        $order = Order::where('id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $id)->get();
        $customer_data = Customer::where('id', $order->customer_id)->first();
        return view('admin.invoice', compact('order', 'order_detail', 'customer_data'));
    }

    public function invoice_edit($id)
    {
        $order = Order::where('id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $id)->get();
        $customer_data = Customer::where('id', $order->customer_id)->first();
        return view('admin.invoice_edit', compact('order', 'order_detail', 'customer_data'));
    }

    public function invoice_update(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();
        $order->status = $request->status;
        $order->save();
        return redirect()->route('admin_orders')->with('success', 'Order Status Updated Successfully');
    }

    public function delete($id)
    {
        $obj = Order::where('id', $id)->delete();
        $obj = OrderDetail::where('order_id', $id)->delete();

        return redirect()->back()->with('success', 'Order is deleted successfully');
    }
}
