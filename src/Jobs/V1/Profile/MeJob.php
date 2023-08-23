<?php

namespace Werify\Account\Laravel\Jobs\V1\Profile;

use Werify\Account\Laravel\Repositories\Contracts\BaseRequest;

class MeJob extends BaseRequest
{
    public $bearer;

    public function __construct(string $bearer = null)
    {
        $this->bearer = $bearer ?? session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable'));
        if ($this->bearer === null) {
            return redirect()->route(config('waccount.login_route'));
        }
    }

    public function handle()
    {
        try {
            $endpoint = $this->generateApiUrl(config('waccount.api.endpoints.profile.me'));
            $req = $this->post($endpoint, null, $this->bearer);
            if ($req->status() === 200) {
                return $req->json();
            }
            throw new \Exception($req->json()['message']);
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw new \Exception($e->getMessage());
            }
            throw new \Exception('WAccount classic me failed');
        }
    }
}
