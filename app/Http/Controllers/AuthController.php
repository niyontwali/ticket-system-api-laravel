<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'sometimes|in:staff,admin'
        ]);

        // Hash the password
        $fields['password'] = Hash::make($fields['password']);
        
        // Set default role if not provided
        if (!isset($fields['role'])) {
            $fields['role'] = 'staff';
        }

        $user = User::create($fields);

        // Create token
        $token = $user->createToken('auth_token');

        return response()->json([
            'message' => 'User created successfully',
            'token' => $token->plainTextToken
        ], 201);
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
           return response()->json([
            'ok' => false,
            'message' => 'The provided credentials are incorrect.'
           ]);
        }

        // Delete previous tokens
        $user->tokens()->delete();

        $token = $user->createToken('auth_token');

        return response()->json([
            'ok' => true,
            'token' => $token->plainTextToken
        ]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get authenticated user details
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}