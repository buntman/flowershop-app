<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use App\Models\Product;

class InventoryController extends Controller
{

    public function inventory():View {
        $products = Product::all();
        return view('admin.inventory', ['products' => $products]);
    }

    public function addProduct(Request $request): RedirectResponse {
        $validated = $request->validate([
            'name' => 'required|unique:products|max:20',
            'quantity' => 'required|min:1',
            'price' => 'required|numeric|min:100',
            'image' => ['required', File::image()
                ->min('1kb')
                ->max('5mb')],
        ]);
        $file = $request->file('image')->store('images');
        $file_name = basename($file);

        Product::create([
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'image_name' => $file_name,
        ]);

        return redirect('/inventory');
    }

    public function fetchCurrentProductDetails(Request $request) {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        $product = Product::find($validated['id']);
        return $product->toJson();
    }

    public function destroy($product_id) {
        Product::where('id', $product_id)->delete();
        return redirect('/inventory');
    }
}
