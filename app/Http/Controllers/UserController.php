<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get authenticated user details
     */
    public function user(Request $request)
    {
        return response()->json([
            'ok' => true,
            'data' => $request->user()
        ]);
    }

      /**
     * Get users 
     */
    public function users()
    {
        $users = User::all();
        
        return response() -> json([
            'ok' => true,
            'data' => $users
        ]);
    }


}