<?php

namespace Werify\Account\Laravel\Enums\V1\Profile;

use Werify\Account\Laravel\Enums\V1\Enums;

enum DarkMode: int
{
    use Enums;

    case LIGHT = 2000;
    case DARK = 2001;

    case SYSTEM = 2002;

    case BATTERY_SAVER = 2003;

}
