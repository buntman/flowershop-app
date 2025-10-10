<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Order;
use App\Enums\OrderItemStatus;
use App\Enums\OrderStatus;


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
        ->where('order_items.status', OrderItemStatus::PENDING)->get();
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
        ->where('order_items.status', OrderItemStatus::COMPLETED)->get();
        return view('admin.dashboard', ['pending_orders' => $pending_orders, 'completed_items' => $completed_items]);
    }

    public function markOrderItemAsCompleted($item_id)
    {
        $item = OrderItem::find($item_id);
        if (!$item) {
            return redirect('/dashboard')->with('error', 'Item does not exists.');
        }
        $item->update(['status' => OrderItemStatus::COMPLETED]);
        $this->updateOrderAsReadyForPickup($item->order_id);
        return redirect('/dashboard')->with('success', 'Successfully mark as completed.');
    }

    public function updateOrderAsReadyForPickup($order_id) {
        $order_items = OrderItem::where('order_id', $order_id)->where('status', OrderItemStatus::PENDING)->first();
        if (!$order_items) {
            Order::where('id', $order_id)->update(['status' => OrderStatus::READY_FOR_PICKUP]);
        }
    }
}
