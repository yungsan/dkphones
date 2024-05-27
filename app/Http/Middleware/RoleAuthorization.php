<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        try {
            $token = JWTAuth::parseToken();
            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {
            return $this->unauthorized('Your token has expired. Please, login again.');
        } catch (TokenInvalidException $e) {
            return $this->unauthorized('Your token is invalid. Please, login again.');
        } catch (JWTException $e) {
            return $this->unauthorized('Please, attach a Bearer Token to your request');
        }



        for ($i = 0; $i < count($roles); $i++) {
            if ($user->DepartmentID == $roles[$i]) {
                return $next($request);
            }
        }

        return $this->unauthorized(null, $user->DepartmentID);
    }

    private function unauthorized($message = null, $department = 0)
    {
        return response()->json([
            'message' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false,
            'deparment' => $department
        ], 401);
    }
}
