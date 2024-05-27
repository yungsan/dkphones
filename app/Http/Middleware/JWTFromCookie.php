<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTFromCookie
{
    public function handle($request, Closure $next)
    {
        if ($token = Cookie::get('jwt_token')) {
            $request->headers->set('Authorization', 'Bearer ' . $token);

            try {
                $user = JWTAuth::setToken($token)->authenticate();
                if ($user) {
                    auth()->setUser($user);
                }
            } catch (\Exception $e) {
                return redirect('/login');
                // return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            return redirect('/login');
            // return response()->json(['error' => 'Token not provided'], 401);
        }

        return $next($request);
    }
}

