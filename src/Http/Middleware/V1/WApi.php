<?php

namespace Werify\Account\Laravel\Http\Middleware\V1;

use Briofy\RestLaravel\Http\Traits\Respond;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Werify\Account\Laravel\Jobs\V1\Profile\MeJob;

class WApi
{
    use Respond;
    public function handle(Request $request, Closure $next): Response
    {
        $token = null;
        $user = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
        if (! $user) {
            return $this->respondUnauthorized(new \Exception('Unauthorized'));
        }
        if (array_key_exists('access_token', $user)) {
            $token = $user['access_token'];
        }
        if (! $token) {
            return $this->respondForbidden(new \Exception('Forbidden'));
        }
        $request->headers->set('Authorization', 'Bearer '.$token);
        try {
            $me = dispatch_sync(new MeJob($token));
            if ($me['succeed']) {
                $data = $me['results'];
                $data['access_token'] = $token;
                session()->driver(config('waccount.session.driver'))->put(config('waccount.session.variable'), $data);
                app()->setLocale($data['language']);
            }
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw new \Exception($e->getMessage());
            }
            session()->driver(config('waccount.session.driver'))->forget(config('waccount.session.variable'));

            return $this->respondWithError(new \Exception('Unhandle Error, Check your token.'));
        }

        return $next($request);
    }
}
