<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            try {
                if ($user = JWTAuth::parseToken()->authenticate()) {
                    $actions = $request->route()->getAction();
                    $role = isset($actions['roles']) ? $actions['roles'] : null;
                    if ($user->hasRole($role)) {
                        return $next($request);
                    }
                    return Response("Anda Tidak Punya Hak Akses Untuk Halaman Ini!", 401);
                }
            } catch (\Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return Response("Token Invalid", 403);
                } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return Response("Token expired", 403);
                } else {
                    return Response("Token not found", 403);
                }
            }
        return response("Login failed", 403);

    }

}
