<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
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
            auth()->userOrFail();
        } catch (Exception $e) {
            switch ($e) {
                case $e instanceof
                    \Tymon\JWTAuth\Exceptions\TokenInvalidException ||
                    $e instanceof \Tymon\JWTAuth\Exceptions\JWTException:
                    return response()->json(
                        ["status" => "Token is Invalid"],
                        401
                    );
                case $e instanceof
                    \Tymon\JWTAuth\Exceptions\TokenExpiredException:
                    return response()->json(
                        ["status" => "Token is Expired"],
                        401
                    );
                default:
                    return response()->json(
                        [
                            "status" => "Authorization Token not found",
                        ],
                        401
                    );
            }
        }
        return $next($request);
    }
}
