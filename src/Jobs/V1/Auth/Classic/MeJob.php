<?php
namespace Werify\Account\Laravel\Jobs\V1\Auth\Classic;


use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class MeJob extends BaseRequest
{
    public $bearer;

    public function __construct(string $bearer)
    {
        $this->bearer = $bearer;
    }

    public function handle(){
        try{
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.auth.classic.me'));
            $req = $this->post($endpoint, null, $this->bearer);
            if ($req->status() === 200) return $req->json();
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount classic me failed');
        }
    }

}