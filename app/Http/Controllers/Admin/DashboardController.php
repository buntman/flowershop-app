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
            'orders.pickup_date',
            'orders.pickup_time'
        )
        ->where('order_items.status', 'Pending')->get();
        $completed_orders = OrderItem::where('status', 'Completed')->get();
        return view('admin.dashboard', ['pending_orders' => $pending_orders, 'completed_orders' => $completed_orders]);
    }
}
