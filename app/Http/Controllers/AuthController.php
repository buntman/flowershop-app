<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    public function getLoginPage():View {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $validated['username'];
        $password = $validated['password'];

        $admin = Admin::where('username', $username)->first();

        if (!$admin || (!Hash::check($password, $admin->password))) {
            return redirect('/admin/login')->withErrors('Invalid input. Please try again.');
        }
        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id);
        return redirect('/inventory');
    }

    public function logout(Request $request): RedirectResponse {
        $request->session()->flush();
        return redirect('/admin/login');
    }
}
