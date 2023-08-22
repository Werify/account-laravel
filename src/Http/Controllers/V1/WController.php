<?php

namespace Werify\Account\Laravel\Http\Controllers\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class WController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public array $user;
    public mixed $userId;
    public function __construct()
    {
        $this->user = session()->driver(config('waccount.session.driver'))->get(config('waccount.session.variable')) ?? [];
        if (array_key_exists('id', $this->user)) $this->userId = $this->user['id'];
    }

}