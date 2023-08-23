<?php

namespace Werify\Account\Laravel\Http\Middleware\V1;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Werify\Account\Laravel\Jobs\V1\Profile\MeJob;

class Auth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = null;
        $user = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
        if (! $user) {
            return redirect()->route(config('waccount.login_route'));
        }
        if (array_key_exists('access_token', $user)) {
            $token = $user['access_token'];
        }
        if (! $token) {
            return redirect()->route(config('waccount.login_route'));
        }
        $request->headers->set('Authorization', 'Bearer '.$token);
        try {
            $me = dispatch_sync(new MeJob($token));
            if ($me['succeed']) {
                $data = $me['results'];
                $data['access_token'] = $token;
                session()->driver(config('waccount.session.driver'))->put(config('waccount.session.variable'), $data);
                if (config('waccount.session.view_variable')) {
                    View::share(config('waccount.session.variable'), $data);
                }
            }
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw new \Exception($e->getMessage());
            }
            session()->driver(config('waccount.session.driver'))->forget(config('waccount.session.variable'));

            return redirect()->route(config('waccount.login_route'));
        }

        return $next($request);
    }
}
