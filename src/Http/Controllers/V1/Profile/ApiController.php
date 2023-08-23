<?php

namespace Werify\Account\Laravel\Http\Controllers\V1\Profile;

use Briofy\RestLaravel\Http\Controllers\RestController;
use Werify\Account\Laravel\Http\Requests\V1\Profile\UpdateRequest;
use Werify\Account\Laravel\Jobs\V1\Profile\MeJob;
use Werify\Account\Laravel\Jobs\V1\Profile\UpdateJob;

class ApiController extends RestController
{
    public function me()
    {
        try {
            return $this->respond(dispatch_sync(new MeJob()));
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                return $this->setErrorMessage($e->getMessage())->respondWithError();
            }

            return $this->setErrorMessage('WAccount profile me failed')->respondWithError();
        }
    }

    public function update(UpdateRequest $r)
    {
        try {
            return $this->respond(dispatch_sync(new UpdateJob(data: $r->validated())));
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                return $this->setErrorMessage($e->getMessage())->respondWithError();
            }

            return $this->setErrorMessage('WAccount profile update failed')->respondWithError();
        }
    }
}
