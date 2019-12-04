<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AllowedAuthProviders extends BaseMiddleware
{

    private $allowedProviders = [
        'github'
    ];

    /**
     * Handle an incoming request.
     * Allow only providers in $allowedProviders
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $provider = $request->route()->parameter('provider');

        if(in_array($provider, $this->allowedProviders)) {
            return $next($request);
        } else {
            return response('Bad Request', 400);
        }

    }
}
