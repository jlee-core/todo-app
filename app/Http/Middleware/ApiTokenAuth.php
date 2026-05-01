<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->header('X-API-TOKEN');

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid Token'], 401);
        }

        // 認証ユーザーをセット
        auth()->guard()->setUser($user);

        return $next($request);
    }
}
