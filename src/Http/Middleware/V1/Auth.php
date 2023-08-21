<?php

namespace Werify\Account\Laravel\Http\Middleware\V1;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Werify\Account\Laravel\Jobs\V1\Auth\Classic\MeJob;

class Auth
{

    public function handle(Request $request, Closure $next): Response
    {
        $token = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
        if (!$token) return redirect()->route(config('waccount.login_route'));
        $request->headers->set('Authorization', 'Bearer '. $token);
        try{
            $me = dispatch_sync(new MeJob($token));
            if ($me['succeed']){
                session()->put('user', $me['results']);
                View::share('user', $me['results']);
            }
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            session()->driver(config('waccount.session.driver'))->forget(config('waccount.session.variable'));
            return redirect()->route(config('waccount.login_route'));
        }
        return $next($request);
    }
}
