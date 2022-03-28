<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function tokens()
    {
        $user = auth('sanctum')->user();
        $tokens = $user->tokens;
        return response(['tokens'=> $tokens],200);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
            'device_name' => 'required|string'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if($user && Hash::check($request->input('password'), $user->password)){
            $token = $user->createToken($request->input('device_name', ['*']))->plainTextToken;
           return Response::json([
               'token' => $token,
               'user' => $user
           ],200);
        }
        return response()->json(['message'=>'Invalid Credentials!'],401);
    }
}
