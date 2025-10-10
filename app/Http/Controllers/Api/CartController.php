<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Enums\CartStatus;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $input = $request->validate([
            'product_id' => 'required|exists:products,id|integer',
        ]);

        $product = Product::find($input['product_id']);

        $user_id = auth('api')->id();

        $cart = Cart::where('user_id', $user_id)->where('status', CartStatus::ACTIVE)->first();

        if (!$cart) {
            $new_cart = Cart::create([ // Create a new cart for user
                'user_id' => $user_id,
                'total' => $product->price,
            ]);
            CartItem::create([
                'cart_id' => $new_cart->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'sub_total' => $product->price,
            ]);
            $this->totalPriceCounter($new_cart);
            return response()->json(['message' => 'Added Successfully!'], 200);
        }
        //product already exists in user's cart
        $existing_cart = CartItem::where('product_id', $product->id)->where('cart_id', $cart->id)->first();
        if ($existing_cart) {
            $existing_cart->increment('quantity');
            $existing_cart->update([
                'sub_total' => DB::raw('quantity * price'),
            ]);
            $this->totalPriceCounter($cart);
            return response()->json(['message' => 'Added Successfully!'], 200);
        }
        //add new product to cart
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'sub_total' => $product->price,
        ]);
        $this->totalPriceCounter($cart);
        return response()->json(['message' => 'Added Successfully!'], 200);
    }

    public function getCartItems()
    {
        $user_id = auth('api')->id();
        $items = DB::table('carts')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->select('cart_items.id', 'products.image_name', 'products.name', 'cart_items.quantity', 'products.price')
        ->where('carts.user_id', $user_id)
        ->where('carts.status', CartStatus::ACTIVE)
        ->get();
        foreach ($items as &$item) {
            $item->image_name = 'http://10.0.2.2:8000/images/' . $item->image_name;
        }
        unset($item);
        return response()->json($items, 200);
    }

    public function deleteItem($item_id)
    {
        $item = CartItem::find($item_id);
        if (!$item) {
            return response()->json(['message' => 'Item does not exist.'], 404);
        }
        $cart = Cart::find($item->cart_id);
        if ($cart->user_id != auth('api')->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $item->delete();
        //if no remaining items in cart, delete the cart
        $remaining_item = CartItem::where('cart_id', $item->cart_id)->first();
        if (!$remaining_item) {
            Cart::where('id', $item->cart_id)->delete();
        }
        return response()->json(['message' => 'Removed from cart successfully.'], 200);
    }

    public function updateItemQuantity(Request $request, $item_id)
    {
        $item = CartItem::find($item_id);
        if (!$item) {
            return response()->json(['message' => 'Item does not exist.'], 404);
        }

        $cart = Cart::find($item->cart_id); //only the owner of the cart can update the quantity.
        if ($cart->user_id != auth('api')->id()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $input = $request->validate([
            'quantity' => 'required|min:1|integer',
        ]);
        $sub_total = $input['quantity'] * $item->price;
        $item->update([
            'quantity' => $input['quantity'],
            'sub_total' => $sub_total,
        ]);
        $this->totalPriceCounter($cart);

        return response()->noContent();
    }


    public function getCartTotal()
    {
        $user_id = auth('api')->id();
        $cart = Cart::where('user_id', $user_id)->where('status', CartStatus::ACTIVE)->first();
        if (!$cart) {
            return response()->json(['total' => 0], 200);
        }
        return response()->json(['total' => $cart->total], 200);
    }

    public function getItemsForCheckout()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->where('status', CartStatus::ACTIVE)->first();
        $active_items = DB::table('carts')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->select('products.id', 'products.name', 'cart_items.quantity', 'cart_items.sub_total')
        ->where('carts.user_id', $user->id)
        ->where('carts.status', CartStatus::ACTIVE)->get();
        return response()->json(['cart_id' => $cart->id, 'items' => $active_items], 200);
    }

    public function totalPriceCounter(Cart $cart)
    {
        $items = CartItem::where('cart_id', $cart->id)->get();
        $cart->update(['total' => $items->sum('sub_total')]);
    }

    public function updateCartStatus($cart_id)
    {
        $cart = Cart::find($cart_id);
        if (!$cart) {
            return response()->json(['message' => 'Cart does not exist.'], 404);
        }
        $cart->update(['status' => CartStatus::CHECKED_OUT]);
        return response()->noContent();
    }
}
