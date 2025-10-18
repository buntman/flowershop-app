<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class GalleryController extends Controller
{
    public function getBouquets()
    {
        $bouquets = Product::select('id', 'name', 'price', 'image_name')->get();
        foreach ($bouquets as &$bouquet) {
            $bouquet['image_name'] = url('images/' . $bouquet['image_name']);
        }
        unset($bouquet);
        return response()->json($bouquets, 200);
    }
}
