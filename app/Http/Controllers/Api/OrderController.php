<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\Api\OrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrder(OrderRequest $request)
    {
        $user = auth()->user();
        $input = $request->validated();
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => $input['payment_method'],
            'total' => $input['total'],
        ]);
        foreach ($input['order_items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'sub_total' => $item['sub_total'],
            ]);
        }
        return response()->json(['message' => 'Order placed successfully!'], 200);
    }

    public function getOrderDetails($status) {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->where('status', $status)->get();
        foreach ($orders as &$order) {
            $order['items'] = $this->getAllItemsInOrder($order['id']);
        }
        unset($order);
        return response()->json(['orders' => $orders]);
    }

    public function getAllItemsInOrder($order_id) {
        $order_items = DB::table('products')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', 'order_items.quantity', 'products.price')
            ->where('order_items.order_id', $order_id)->get();
        return $order_items;
    }
}
