<?php

namespace Werify\Account\Laravel\Jobs\V1\Profile;

use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class UpdateJob extends BaseRequest
{
    public string $bearer;

    public array $data;

    public function __construct(string $bearer = null, array $data = [])
    {
        if (empty($bearer)) {
            $user = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
            if ($user === null) {
                return throw new \Exception('WAccount session user not found');
            }
            if (! array_key_exists('access_token', $user)) {
                return throw new \Exception('WAccount bearer token not found');
            }
            $this->bearer = $user['access_token'];
        } else {
            $this->bearer = $bearer;
        }
        if (empty($this->bearer)) {
            return throw new \Exception('WAccount bearer token not found');
        }
        $this->data = $data;
    }

    public function handle()
    {
        try {
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.profile.update'));
            $req = $this->put($endpoint, $this->data, $this->bearer);
            if ($req->status() === 200) {
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw new \Exception($e->getMessage());
            }
            throw new \Exception('WAccount update profile failed');
        }
    }
}
