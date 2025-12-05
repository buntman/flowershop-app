<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $input = $request->validated();
        User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        return response()->json(['message' => 'Registered Succesfully.'], 200);
    }

    public function login(LoginRequest $request) {
        if (RateLimiter::tooManyAttempts('login:' . $request->ip(), $per_minute = 5)) {
            $seconds = RateLimiter::availableIn('login:' . $request->ip());
            return response()->json(['message' => 'Too many login attempts. Try again in ' . $seconds . ' seconds.'], 429);
        }
        RateLimiter::increment('login:' . $request->ip());

        $input = $request->validated();
        $user = User::where('email', $input['email'])->first();
        if (!$user || !Hash::check($input['password'], $user->password)) {
            return response()->json(['message' => 'Invalid input. Please try again.'], 422);
        }
        return response()->json(['token' => $user->createToken('some-device-name')->plainTextToken,
            'message' => 'Successful login'], 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
