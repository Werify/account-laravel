<?php

namespace Werify\Account\Laravel\Http\Controllers\V1\Profile;

use Illuminate\Routing\Controller;
use Werify\Account\Laravel\Http\Requests\V1\Profile\UpdateRequest;
use Werify\Account\Laravel\Jobs\V1\Profile\UpdateJob;
use Werify\Account\Laravel\WAccount;

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
                try {
                    dispatch_sync(new UpdateJob(data: $data));
                } catch (\Exception $e) {
                    session()->driver(config('waccount.session.driver'))->put('language', $r->input('language'));
                }
            }

            return redirect(WAccount::replaceLanguageInUrl(url()->previous(), $r->input('language')));
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
            try {
                dispatch_sync(new UpdateJob(data: $data));
            } catch (\Exception $e) {
                session()->driver(config('waccount.session.driver'))->put('dark_mode', $r->input('dark_mode'));
            }

            return redirect(url()->previous());
        } catch (\Exception $e) {
            if (config('waccount.debug')) {
                throw $e;
            }

            return throw new \Exception('Something went wrong');
        }
    }


}