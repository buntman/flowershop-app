<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class GalleryController extends Controller
{
    public function fetchBouquets() {
        $bouquets = Product::select('id', 'name', 'price', 'image_name')->get();
        foreach ($bouquets as &$bouquet) {
            $bouquet['image_name'] = 'http://10.0.2.2:8000/images/' . $bouquet['image_name'];
        }
        unset($bouquet);
        return response()->json($bouquets, 200);
    }
}
