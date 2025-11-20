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
        $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'users.name as customer_name',
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
