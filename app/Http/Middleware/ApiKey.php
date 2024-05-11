<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $apiKey = $request->header('api_key');

        // if ($apiKey !== 'beautyoiuwhdu98734mnzs657fdfgdf') {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // return $next($request);
        $apiKey = $request->header('api_key');
        if (!$apiKey) {
            return response()->json(['message' => 'Unauthorized. API key is missing.'], 401);
        }

        $user = User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized. Invalid API key.'], 401);
        }

        return $next($request);
    }
}
