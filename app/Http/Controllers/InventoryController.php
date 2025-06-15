<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use App\Models\Product;

class InventoryController extends Controller
{
    private $product;

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

        $product = new Product();

        $product->name = $validated['name'];
        $product->quantity = $validated['quantity'];
        $product->price = $validated['price'];
        $product->image_name = $file_name;
        $product->save();

        return redirect('/inventory');
    }

    public function destroy(Request $request, $product_id) {
        Product::where('id', $product_id)->delete();
        return redirect('/inventory');
    }
}
