<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($product_id) {
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json(['message' => 'Product does not exist!'], 422);
        }

        $user_id = auth('api')->id();

        $cart = Cart::where('user_id', $user_id)->where('status', 'active')->first();
        // Create a new cart for the user and add the selected product as the first cart item
        if (!$cart) {
            Cart::create([
                'user_id' => $user_id,
                'total_price' => $product->price,
            ]);
            $cart = Cart::where('user_id', $user_id)->where('status', 'active')->first();
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'price' => $product->price,
                'sub_total' => $product->price,
            ]);
            return response()->json(['message' => 'Added Successfully!'], 200);
        }

        //product already exists in user's cart
        $cart_item = CartItem::where('product_id', $product_id)->where('cart_id', $cart->id)->first();
        if ($cart_item) {
            $cart_item->increment('quantity');
            $cart_item->update([
                'sub_total' => DB::raw('quantity * price'),
            ]);
            return response()->json(['message' => 'Added Successfully!'], 200);
        }

        //add new product to cart
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product_id,
            'price' => $product->price,
            'sub_total' => $product->price,
        ]);
        return response()->json(['message' => 'Added Successfully!'], 200);
    }
}
