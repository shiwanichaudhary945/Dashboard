<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // 'device_id' => 'required|string|max:255',
            // 'department' => 'required|string|max:255',
            'role' => 'required|string|in:employee,admin'
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => Hash::make($request->password),
            // 'device_id' => $request->device_id,
            // 'department' => $request->department,
            'role' => $request->role,
        ]);

        return response()->json([
            "status" => true,
            "message" => "User registered successfully!",
            "data" => []
        ]);
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
            // 'device_id' => 'required|string|max:255',
        ]);

        // Email check
        $user = User::where("email", $request->email)->first();

        if ($user) {
            // User exists
            if (Hash::check($request->password, $user->password)) {


                // Device ID check
                if ($user->device_id === $request->device_id) {


                // Password matched
                $token = $user->createToken("mytoken")->plainTextToken;

                return response()->json([
                    "status" => true,
                    "message" => "User logged in",
                    "token" => $token,
                    'role' => $user->role,
                    "data" => []
                ]);
            } else {
                // Invalid device_id
                return response()->json([
                    "status" => false,
                    "message" => "Invalid device ID!",
                    "data" => []
                ]);
            }
        } else {
            // Invalid password
            return response()->json([
                "status" => false,
                "message" => "Invalid password!",
                "data" => []
            ]);
        }
    } else {

        return response()->json([
            "status" => false,
            "message" => "Email does not match!",
            "data" => []
        ]);
    }
}
}
