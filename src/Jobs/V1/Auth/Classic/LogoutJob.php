<?php
namespace Werify\Account\Laravel\Jobs\V1\Auth\Classic;

use Illuminate\Support\Facades\Cookie;
use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class LogoutJob extends BaseRequest
{

    public $bearer;

    /**
     * @throws \Exception
     */
    public function __construct(string $bearer = null)
    {
        if(!$this->bearer){
            $user = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
            if ($user === null) return throw new \Exception('WAccount session user not found');
            if(!array_key_exists('access_token', $user)) return throw new \Exception('WAccount bearer token not found');
            $this->bearer = $user['access_token'];
        }else{
            $this->bearer = $bearer;
        }
        if ($this->bearer === null) return throw new \Exception('WAccount bearer token not found');
    }

    public function handle(){
        try{
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.auth.classic.logout'));
            $req = $this->post($endpoint, null, $this->bearer);
            if ($req->status() === 200){
                session()->driver(config('waccount.session.driver'))->forget(config('waccount.session.variable'));
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount classic logout failed');
        }
    }

}