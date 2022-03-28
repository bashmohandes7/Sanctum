<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('x-api-key');
        if( $key !== config('app.api_key')){
            return response()->json([
                'message' => 'Invalid Api Key'
            ],404);
        }
        $user = auth('sanctum')->user();
        if ($user) {
            $user->currentAccessToken()->forceFill([
            'ip_address'=> $request->ip()
        ])->save();
        }
        return $next($request);
    }
}
