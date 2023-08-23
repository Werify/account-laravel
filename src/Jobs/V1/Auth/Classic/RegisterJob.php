<?php

namespace Werify\Account\Laravel\Jobs\V1\Auth\Classic;

use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class RegisterJob extends BaseRequest
{
    public $data;

    public function __construct(array $data)
    {
        $this->data['identifier'] = $data['identifier'];
        if (isset($data['password'])) {
            $this->data['password'] = $data['password'];
        } $this->data['password_confirmation'] = $data['password_confirmation'];
        if (isset($data['first_name'])) {
            $this->data['first_name'] = $data['first_name'];
        }
    }

    public function handle()
    {
        try {
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.auth.classic.register'));
            $req = $this->post($endpoint, $this->data);
            if ($req->status() === 200 or $req->status() === 201) {
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw new \Exception($e->getMessage());
            }
            throw new \Exception('WAccount classic register failed');
        }
    }
}
