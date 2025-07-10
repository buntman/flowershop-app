<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLoginPage(): View
    {
        return view('auth.login');
    }

    public function login(AuthRequest $request): RedirectResponse
    {
        if (Auth::guard('admin')->attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('inventory');
        }

        return back()->withErrors(['username' => 'The provided credentials does not match our records.'
        ])->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
