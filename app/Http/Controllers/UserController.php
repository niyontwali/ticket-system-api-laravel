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
        return $request->user();
    }

      /**
     * Get users 
     */
    public function users()
    {
        return User::all();
    }


}