<?php
namespace Werify\Account\Laravel\Jobs\V1\Auth\Classic;

use Illuminate\Support\Facades\Cookie;
use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class LogoutJob extends BaseRequest
{

    public $bearer;

    public function __construct(string $bearer = null)
    {
        $this->bearer = $bearer ?? Cookie::get(config('waccount.cookie_name'));
        if ($this->bearer === null) return redirect()->route(config('waccount.login_route'));
    }

    public function handle(){
        try{
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.auth.classic.logout'));
            $req = $this->post($endpoint, null, $this->bearer);
            if ($req->status() === 200){
                Cookie::make(config('waccount.cookie_name'), null, -1);
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount classic logout failed');
        }
    }

}