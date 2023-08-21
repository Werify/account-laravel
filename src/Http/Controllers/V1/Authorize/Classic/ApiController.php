<?php
namespace Werify\Account\Laravel\Http\Controllers\V1\Authorize\Classic;

use Briofy\RestLaravel\Http\Controllers\RestController;
use Werify\Account\Laravel\Http\Requests\V1\Authorize\Classic\CheckRequest;
use Werify\Account\Laravel\Http\Requests\V1\Authorize\Classic\StartRequest;
use Werify\Account\Laravel\Http\Resources\V1\Authorize\Classic\StartResource;
use Werify\Account\Laravel\Jobs\V1\Authorize\Classic\CheckJob;
use Werify\Account\Laravel\Jobs\V1\Authorize\Classic\StartJob;

class ApiController extends RestController
{

    public function start(StartRequest $r){
        try{
            $scopes = $r->input('scopes', []);
            return $this->respond(StartResource::make(dispatch_sync(new StartJob($scopes))));
        }catch (\Exception $e){
            if (config('waccount.debug')) return $this->setErrorMessage($e->getMessage())->respondWithError();
            return $this->setErrorMessage('WAccount authorize start failed')->respondWithError();
        }
    }

    public function check(CheckRequest $r){
        try{
            $token = $r->input('token');
            return $this->respond(dispatch_sync(new CheckJob($token)));
        }catch (\Exception $e){
            if (config('waccount.debug')) return $this->setErrorMessage($e->getMessage())->respondWithError();
            return $this->setErrorMessage('WAccount classic register failed')->respondWithError();
        }
    }

}