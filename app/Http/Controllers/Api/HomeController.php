<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function getNewBouquets()
    {
        $bouquets = Product::select('name', 'price', 'image_name')
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();
        foreach ($bouquets as &$bouquet) {
            $bouquet['image_name'] = url('images/' . $bouquet['image_name']);
        }
        unset($bouquet);
        return response()->json($bouquets, 200);
    }
}
