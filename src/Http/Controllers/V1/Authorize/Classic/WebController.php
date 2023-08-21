<?php
namespace Werify\Account\Laravel\Http\Controllers\V1\Authorize\Classic;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use mysql_xdevapi\Exception;
use Werify\Account\Laravel\Jobs\V1\Authorize\Classic\CheckJob;
use Werify\Account\Laravel\Jobs\V1\Authorize\Classic\StartJob;

class WebController extends Controller
{

    public function start()
    {
        try{
            $res = dispatch_sync(new StartJob());
            return $res['succeed'] ? redirect($res['results']['url']) : throw new \Exception($res['message']);
        }catch (\Exception $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function check(Request $r)
    {
        $token = $r->token;
        $res = dispatch_sync(new CheckJob($token));
        return $res['succeed'] ? redirect()->route(config('waccount.home_route')) : throw new Exception($res['message']);
    }

}