<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $pending_orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'users.name as user_name',
            'orders.id as order_id',
            'order_items.id as item_id',
            'products.image_name',
            'products.name as product_name',
            'order_items.quantity',
        )
        ->where('order_items.status', 'pending')->get();
        $completed_items = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'users.name as user_name',
            'orders.id as order_id',
            'order_items.id as item_id',
            'products.image_name',
            'products.name as product_name',
            'order_items.quantity',
        )
        ->where('order_items.status', 'completed')->get();
        return view('admin.dashboard', ['pending_orders' => $pending_orders, 'completed_items' => $completed_items]);
    }

    public function markOrderItemAsCompleted($item_id)
    {
        $item = OrderItem::where('id', $item_id)->first();
        if (!$item) {
            return redirect('/dashboard')->with('error', 'Item does not exists.');
        }
        $item->update(['status' => 'completed']);
        return redirect('/dashboard')->with('success', 'Successfully mark as completed.');
    }
}
