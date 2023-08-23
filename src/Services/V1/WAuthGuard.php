<?php

namespace Werify\Account\Laravel\Services\V1;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Session\Session;

class WAuthGuard extends SessionGuard
{
    public function __construct($request, UserProvider $provider, Session $session, $name = null)
    {
        parent::__construct($name, $provider, $session, $request);
    }
}
