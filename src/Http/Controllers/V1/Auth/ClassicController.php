<?php
namespace Werify\Account\Laravel\Http\Controllers\V1\Auth;

use Briofy\RestLaravel\Http\Controllers\RestController;
use Werify\Account\Laravel\Http\Requests\V1\Auth\Classic\LoginRequest;
use Werify\Account\Laravel\Http\Requests\V1\Auth\Classic\RegisterRequest;
use Werify\Account\Laravel\Http\Resources\V1\Auth\Classic\LoginResource;
use Werify\Account\Laravel\Jobs\V1\Auth\Classic\LoginJob;
use Werify\Account\Laravel\Jobs\V1\Auth\Classic\RegisterJob;

class ClassicController extends RestController
{

    public function login(LoginRequest $r){
        try{
            return $this->respond(LoginResource::make(dispatch_sync(new LoginJob($r->validated()))));
        }catch (\Exception $e){
            if (config('waccount.debug')) return $this->setErrorMessage($e->getMessage())->respondWithError();
            return $this->setErrorMessage('WAccount classic login failed')->respondWithError();
        }
    }

    public function register(RegisterRequest $r){
        try{
            return $this->respond(dispath_sync(new RegisterJob($r->validated())));
        }catch (\Exception $e){
            if (config('waccount.debug')) return $this->setErrorMessage($e->getMessage())->respondWithError();
            return $this->setErrorMessage('WAccount classic register failed')->respondWithError();
        }
    }


}