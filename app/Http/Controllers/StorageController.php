<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function show(Request $request, $filename) {
        $folder = 'images';
        $path = $folder . '/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        return Storage::response($path);
    }
}
