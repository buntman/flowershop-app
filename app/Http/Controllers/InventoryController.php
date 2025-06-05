<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class InventoryController extends Controller
{
    public function inventory():View {
        return view('inventory');
    }
}
