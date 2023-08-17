<?php
namespace Werify\Account\Laravel\Jobs\V1\Auth\Classic;


use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class LoginJob extends BaseRequest
{
    public $identifier, $password;

    public function __construct(array $data)
    {
        $this->identifier = $data['identifier'];
        $this->password = $data['password'];
    }

    public function handle(){
        try{
            $this->data = [
                'identifier' => $this->identifier,
                'password' => $this->password,
            ];
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.auth.classic.login'));
            $req = $this->post($endpoint, $this->data);
            if ($req->status() === 200){
                cookie()->queue(config('waccount.cookie_name'), $req->json()['results']['access_token'], 60 * 24 * 30);
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('WAccount classic login failed');
        }
    }

}