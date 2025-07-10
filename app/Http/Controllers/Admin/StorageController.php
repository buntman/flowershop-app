<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class StorageController extends Controller
{
    public function show(Request $request, $filename)
    {
        $folder = 'images';
        $path = $folder . '/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        return Storage::response($path);
    }
}
