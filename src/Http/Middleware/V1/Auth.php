<?php

namespace Werify\Account\Laravel\Http\Middleware\V1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Werify\Account\Laravel\Jobs\V1\Auth\Classic\MeJob;

class Auth
{

    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie(config('waccount.cookie_name'));
        if (!$token) return redirect()->route(config('waccount.login_route'));
        $request->headers->set('Authorization', 'Bearer '. $token);
        $me = dispatch_sync(new MeJob($token));
        if ($me['succeed']) $request['wauth'] = $me['results'];
        $response = $next($request);
        if ($response->getStatusCode() == 401) {
            cookie()->queue(cookie()->forget(config('waccount.cookie_name')));
            return redirect()->route(config('waccount.login_route'));
        }
        return $response;
    }
}