<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function singleDevice($id)
    {
        $user = auth('sanctum')->user();
        $user->tokens()->findOrFail($id)->delete();
        return response()->json(['message'=> 'Signout Successfully'],200);
    }

    public function CurrentDevice()
    {
        $user = auth('sanctum')->user();
        $user->currentAccessToken()->delete();
        return response()->json(['message'=> 'logout Successfully'],200);
    }
    public function allDevices()
    {
        $user = auth('sanctum')->user();
        $user->tokens()->delete();
        return response(['message'=>'logout from all Devices Successfully'],200);
    }
}
