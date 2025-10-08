<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\Api\OrderRequest;

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
}
