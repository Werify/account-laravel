<?php
namespace Werify\Account\Laravel\Jobs\V1\Authorize\Classic;

use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class StartJob extends BaseRequest
{
    public array $scopes;

    public function __construct(array $scopes = [])
    {
        $this->scopes = $scopes;
    }

    public function handle(){
        try{
            $this->data = [
                'scopes' => $this->scopes,
            ];
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.authorize.classic.start'));
            $req = $this->post($endpoint, $this->data);
            if ($req->status() === 200) return $req->json();
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount authorize start failed');
        }
    }

}