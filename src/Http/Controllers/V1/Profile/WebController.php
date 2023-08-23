<?php

namespace Werify\Account\Laravel\Http\Controllers\V1\Profile;

use Illuminate\Routing\Controller;
use Werify\Account\Laravel\Enums\V1\Profile\DarkMode;
use Werify\Account\Laravel\Enums\V1\Profile\Language;
use Werify\Account\Laravel\Http\Requests\V1\Profile\UpdateRequest;
use Werify\Account\Laravel\Jobs\V1\Profile\UpdateJob;

class WebController extends Controller
{
    public function localization(UpdateRequest $r)
    {
        try {
            $data = [];
            if ($r->has('language')) {
                $data['language'] = $r->input('language');
            }
            if ($r->has('country')) {
                $data['country'] = $r->input('country');
            }
            if ($r->has('timezone')) {
                $data['timezone'] = $r->input('timezone');
            }
            if ($r->has('currency')) {
                $data['currency'] = $r->input('currency');
            }
            if (! empty($data)) {
                dispatch_sync(new UpdateJob(data: $data));
            }

            return redirect(str_replace(Language::toArray(), $r->input('language'), url()->previous()));
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw $e;
            }

            return throw new \Exception('Something went wrong');
        }
    }

    public function darkMode(UpdateRequest $r)
    {
        try {
            $data = ['dark_mode' => $r->input('dark_mode')];
            dispatch_sync(new UpdateJob(data: $data));

            return redirect(str_replace(DarkMode::toArray(), $r->input('dark_mode'), url()->previous()));
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw $e;
            }

            return throw new \Exception('Something went wrong');
        }
    }
}
