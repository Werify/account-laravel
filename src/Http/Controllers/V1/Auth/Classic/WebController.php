<?php
namespace Werify\Account\Laravel\Http\Controllers\V1\Auth\Classic;

use Illuminate\Routing\Controller;
use Werify\Account\Laravel\Jobs\V1\Auth\Classic\LogoutJob;

class WebController extends Controller
{
    public function logout(){
        try{
            $res = dispatch_sync(new LogoutJob());
            return $res['succeed'] ? redirect()->route(config('waccount.logout_route')) : throw new \Exception($res['message']);
        }catch (\Exception $e){
            if (config('waccount.debug')) return $this->setErrorMessage($e->getMessage())->respondWithError();
            return $this->setErrorMessage('WAccount classic logout failed')->respondWithError();
        }
    }


}