<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\Api\OrderRequest;

class OrderController extends Controller
{
    public function createOrder(OrderRequest $request) {
        $user = auth()->user();
        $input = $request->validated();
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method' => $input['payment_method'],
            'pickup_date' => $input['pickup_date'],
            'pickup_time' => $input['pickup_time'],
            'total' => $input['total'],
        ]);
        foreach ($input['order_items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'sub_total' => $item['subTotal'],
            ]);
        }
        return response()->json(['message' => 'Order placed successfully!'], 200);
    }
}
