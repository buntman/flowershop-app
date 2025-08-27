<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function getUser(Request $request)
    {
        $user = auth()->user();

        //fetch user details
        if ($request->query('details') !== 'complete') {
            return response()->json($user->only(['email', 'name', 'contact_number']), 200);
        }

        //checks if user details are updated
        if ($user->name == null || $user->contact_number == null) {
            return response()->json(['success' => false,
                'message' => 'Please update your details first before proceeding.'], 200);
        }
        return response()->json(['success' => true], 200);
    }

    public function updateProfile(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|min:2|max:50',
            'contact_number' => 'required|digits:11',
        ]);
        $user = auth()->user();
        if ($user->name == $input['name'] && $user->contact_number == $input['contact_number']) {
            return response()->noContent();
        }
        User::where('id', $user->id)->update([
            'name' => $input['name'],
            'contact_number' => $input['contact_number'],
        ]);
        return response()->json(['message' => 'Updated Successfully.'], 200);
    }
}
