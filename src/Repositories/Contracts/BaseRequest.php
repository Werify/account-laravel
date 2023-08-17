<?php
namespace Bulutly\Laravel\Repositories\Contracts;

use Illuminate\Support\Facades\Http;

abstract class BaseRequest
{
    public function post($path, $payload = null, $token = null, $key = null)
    {
        if ($payload === null) return Http::withHeaders($this->getHeaders($token, $key))->post($path);
        return Http::withHeaders($this->getHeaders($token, $key))->post($path, $payload);
    }

    public function put($path, $payload = null, $token = null, $key = null)
    {
        if ($payload === null) return Http::withHeaders($this->getHeaders($token, $key))->put($path);
        return Http::withHeaders($this->getHeaders($token, $key))->put($path, $payload);
    }

    public function delete($path, $payload = null, $token = null, $key = null)
    {
        if ($payload === null) return Http::withHeaders($this->getHeaders($token, $key))->delete($path);
        return Http::withHeaders($this->getHeaders($token, $key))->delete($path, $payload);
    }

    public function get($path, $token = null, $key = null)
    {
        return Http::withHeaders($this->getHeaders($token, $key))->get($path);
    }

    public function generateApiUrl(string $path): string
    {
        $baseUrl = config('bulutly.sandbox', false) ? config('bulutly.api.sandbox_url') : config('bulutly.api.url');
        return $baseUrl.'/'.config('bulutly.api.version').'/'.$path;

    }

    public function getHeaders($token = null, $key = null): array
    {
        $headers = [
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ];
        $headers['X-BULUTLY-API'] = $key ?? config('bulutly.api.key');
        if ($token) $headers['Authorization'] = 'Bearer '.$token;
        return $headers;
    }

}