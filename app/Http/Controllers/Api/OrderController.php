<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Http\Requests\Api\OrderRequest;

class OrderController extends Controller
{
    public function fetchItemsToOrder() {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->where('status', 'active')->first();
        $order_items = DB::table('carts')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->select('products.id', 'products.name', 'cart_items.quantity', 'cart_items.sub_total')
        ->where('carts.user_id', $user->id)
        ->where('carts.status', 'active')->get();
        return response()->json(['cart_id' => $cart->id, 'items' => $order_items], 200);
    }

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
