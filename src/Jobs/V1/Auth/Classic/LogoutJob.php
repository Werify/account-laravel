<?php
namespace Werify\Account\Laravel\Jobs\V1\Auth\Classic;


use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class LogoutJob extends BaseRequest
{

    public $bearer;

    public function __construct(string $bearer = null)
    {
        $this->bearer = $bearer ?? cookie(config('waccount.cookie_name'));
        if ($this->bearer === null) return redirect()->route(config('waccount.login_route'));
    }

    public function handle(){
        try{
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.auth.classic.logout'));
            $req = $this->post($endpoint, null, $this->bearer);
            if ($req->status() === 200){
                cookie()->queue(cookie()->forget(config('waccount.cookie_name')));
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount classic logout failed');
        }
    }

}