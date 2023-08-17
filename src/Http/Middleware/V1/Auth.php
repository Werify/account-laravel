<?php

namespace Werify\Account\Laravel\Http\Middleware\V1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{

    public function handle(Request $request, Closure $next): Response
    {
        $token = cookie()->get(config('waccount.cookie_name'));
        if (!$token) return redirect()->route(config('waccount.login_route'));
        $request->headers->set('Authorization', 'Bearer '. $token);
        $response = $next($request);
        if ($response->getStatusCode() == 401) {
            cookie()->queue(cookie()->forget(config('waccount.cookie_name')));
            return redirect()->route(config('waccount.login_route'));
        }
        return $response;
    }
}