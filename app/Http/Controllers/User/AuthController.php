<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $input = $request->validated();
        User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        return response()->json(['message' => 'Registered Succesfully.']);
    }

    public function login(LoginRequest $request) {
        $input = $request->validated();
        $user = User::where('email', $input['email'])->first();

        if (!$user || !Hash::check($input['password'], $user['password'])) {
            return response()->json(['message' => 'Invalid input. Please try again.'], 422);
        }
        return response()->json(['token' => $user->createToken($input['email'])->plainTextToken], 200);
    }
}
