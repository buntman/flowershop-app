<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class InventoryController extends Controller
{
    public function inventory(): View
    {
        $products = Product::all();
        return view('admin.inventory', ['products' => $products]);
    }

    public function addProduct(AddProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $file = $validated['image']->store('images');
        $file_name = basename($file);

        Product::create([
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'image_name' => $file_name,
        ]);

        return redirect('/inventory')->with('success', 'Product added successfully.');
    }

    public function fetchCurrentProductDetails($product_id)
    {
        $product = Product::find($product_id);
        return response()->json($product);
    }

    public function update(EditProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $product = Product::find($validated['productId']);
        if (
            $product->name == $validated['name'] &&
            $product->quantity == $validated['quantity'] &&
            bccomp($product->price, $validated['price'], 2) === 0) { //compare up to 2 decimal places
            return redirect('/inventory')->with('error', 'No changes detected. Please make a change before submitting.');
        }

        Product::where('id', $validated['productId'])->update([
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price']
        ]);

        return redirect('/inventory')->with('success', 'Product edited successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete('images/' . $product->image_name); //remove the file in storage
        $product->delete();
        return redirect('/inventory')->with('success', 'Product deleted successfully.');
    }
}
