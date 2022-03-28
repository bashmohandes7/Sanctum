<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'string|confirmed',
            'name' => 'required|string'
        ]);

        User::create([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'name'=> $request->input('name')
        ]);

        return response()->json([
            'message' => 'User Created Successfully'
        ]);
    }
}
