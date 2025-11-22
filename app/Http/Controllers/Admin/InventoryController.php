<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddProductRequest;
use App\Http\Requests\Admin\EditProductRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class InventoryController extends Controller
{
    public function inventory(): View
    {
        $products = Product::all();
        return view('admin.inventory', ['products' => $products]);
    }

    public function add(AddProductRequest $request)
    {
        $input = $request->validated();
        $file = $input['image']->store('images');
        $file_name = basename($file);

        Product::create([
            'name' => $input['name'],
            'quantity' => $input['quantity'],
            'price' => $input['price'],
            'image_name' => $file_name,
        ]);

        return back()->with('success', 'Product added successfully.');
    }

    public function get($product_id)
    {
        $product = Product::find($product_id);
        return response()->json($product);
    }

    public function update(EditProductRequest $request)
    {
        $input = $request->validated();

        $product = Product::find($input['productId']);
        if (
            $product->name == $input['name'] &&
            $product->quantity == $input['quantity'] &&
            bccomp($product->price, $input['price'], 2) === 0) {
            return back()->with('error', 'No changes detected. Please make a change before submitting.');
        }

        Product::where('id', $input['productId'])->update([
            'name' => $input['name'],
            'quantity' => $input['quantity'],
            'price' => $input['price']
        ]);

        return back()->with('success', 'Product edited successfully.');
    }

    public function destroy(Product $product)
    {
        Storage::delete('images/' . $product->image_name); //remove the file in storage
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
