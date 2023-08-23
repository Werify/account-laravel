<?php

namespace Werify\Account\Laravel\Repositories\Contracts;

use Illuminate\Support\Facades\Http;

abstract class BaseRequest
{
    public function post($path, $payload = null, $token = null)
    {
        if ($payload === null) {
            return Http::withHeaders($this->getHeaders($token))->post($path);
        }

        return Http::withHeaders($this->getHeaders($token))->post($path, $payload);
    }

    public function put($path, $payload = null, $token = null)
    {
        if ($payload === null) {
            return Http::withHeaders($this->getHeaders($token))->put($path);
        }

        return Http::withHeaders($this->getHeaders($token))->put($path, $payload);
    }

    public function delete($path, $payload = null, $token = null)
    {
        if ($payload === null) {
            return Http::withHeaders($this->getHeaders($token))->delete($path);
        }

        return Http::withHeaders($this->getHeaders($token))->delete($path, $payload);
    }

    public function get($path, $token = null)
    {
        return Http::withHeaders($this->getHeaders($token))->get($path);
    }

    public function generateApiUrl(string $path): string
    {
        $baseUrl = config('waccount.sandbox', false) ? config('waccount.api.sandbox_url') : config('waccount.api.url');

        return $baseUrl.'/'.config('waccount.api.version').'/'.$path;

    }

    public function getHeaders($token = null): array
    {
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'X-WACCOUNT-CLIENT-ID' => config('waccount.client_id'),
            'X-WACCOUNT-CLIENT-SECRET' => config('waccount.client_secret'),
        ];
        if ($token) {
            $headers['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }
}
