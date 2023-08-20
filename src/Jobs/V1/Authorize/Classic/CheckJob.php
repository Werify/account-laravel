<?php
namespace Werify\Account\Laravel\Jobs\V1\Authorize\Classic;

use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class CheckJob extends BaseRequest
{
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function handle(){
        try{
            $this->data = [
                'token' => $this->token,
            ];
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.authorize.classic.check'));
            $req = $this->post($endpoint, $this->data);
            if ($req->status() === 200){
                cookie()->queue(config('waccount.cookie_name'), $req->json()['results']['access_token'], 60 * 24 * 30);
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount authorize check failed');
        }
    }

}