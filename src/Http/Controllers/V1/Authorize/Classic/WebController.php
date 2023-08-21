<?php
namespace Werify\Account\Laravel\Http\Controllers\V1\Authorize\Classic;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Werify\Account\Laravel\Jobs\V1\Authorize\Classic\CheckJob;
use Werify\Account\Laravel\Jobs\V1\Authorize\Classic\StartJob;

class WebController extends Controller
{

    public function start()
    {
        try{
            $authorize = dispatch_sync(new StartJob());
            return $authorize['succeed'] ? redirect($authorize['results']['url']) : redirect()->back()->withInput()->withErrors($authorize['message']);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function check(Request $r)
    {
        $token = $r->token;
        $res = dispatch_sync(new CheckJob($token));
        return $res['succeed'] ? redirect()->route(config('waccount.home_route')) : redirect()->back()->withErrors($res['message']);
    }

}