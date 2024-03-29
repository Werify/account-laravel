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
        if ($request->hasHeader('Authorization')) {
            $token = $request->header('Authorization');
        } else {
            return $this->respondInvalidParameters(new \Exception('Authorization Token Required.'));
        }
        $request->headers->set('Authorization', $token);
        try {
            $rawToken = str_replace('Bearer ', '', $token);
            $me = dispatch_sync(new MeJob($rawToken));
            if ($me['succeed']) {
                $data = $me['results'];
                $data['access_token'] = $rawToken;
                app()->setLocale($data['language']);
                $request->merge(['user' => $data]);
            }
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw new \Exception($e->getMessage());
            }

            return $this->respondWithError(new \Exception('Unhandle Error, Check your token.'));
        }

        return $next($request);
    }
}
