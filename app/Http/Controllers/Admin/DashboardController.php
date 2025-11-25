<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function getDashboard()
    {
        $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'users.name as customer_name',
            'users.contact_number',
            'orders.id as order_id',
            'orders.order_number',
            'orders.total',
            'orders.status'
            )->get();
        return view('admin.dashboard', ['orders' => $orders]);
    }

    public function getOrderDetails($order_id) {
        $order_details = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'orders.id as order_id',
            'products.name as product_name',
            'order_items.quantity',
            'products.price'
        )
        ->where('orders.id', $order_id)->get();
        return response()->json($order_details);
    }

    public function updateOrderStatus(Request $request, $order_id) {
        $order = Order::findOrFail($order_id);
        $request->validate([
            'status' => 'required|in:pending,ready_for_pickup,completed'
        ]);
        $order->status = $request->status;
        $order->save();
        return back()->with('success', 'Status updated!');
    }
}
