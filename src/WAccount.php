<?php

namespace Werify\Account\Laravel;

use Stevebauman\Location\Facades\Location;
use Werify\Account\Laravel\Enums\V1\Profile\Language;

final class WAccount
{
    public static function initializeIndex(string $previous_url, string $lang = null)
    {
        if (! empty($lang)) {
            $language = $lang;
        } else {
            $country = null;
            if (array_key_exists('HTTP_CF_IPCOUNTRY', $_SERVER)) {
                $country = $_SERVER['HTTP_CF_IPCOUNTRY'];
            } else {
                if ($position = Location::get()) {
                    $country = $position->countryCode;
                }
            }
            $language = Language::byCountry($country);
        }
        app()->setLocale($language);
        session()->driver(config('waccount.session.driver'))->put('language', $language);

        $url = $previous_url ? self::replaceLanguageInUrl($previous_url, $language) : self::replaceLanguageInUrl(config('waccount.home_route'), $language);
        return redirect($url);
    }

    public static function replaceLanguageInUrl($url, $newLanguage = null)
    {
        if (empty($newLanguage)) {
            $newLanguage = config('app.locale');
        }
        $parsedUrl = parse_url($url);

        // Replace language code in path
        if (isset($parsedUrl['path'])) {
            $pathSegments = explode('/', trim($parsedUrl['path'], '/'));
            if (count($pathSegments) > 0) {
                $pathSegments[0] = $newLanguage;
                $parsedUrl['path'] = '/'.implode('/', $pathSegments);
            } else {
                $parsedUrl['path'] = '/'.$newLanguage;
            }
        } else {
            $parsedUrl['path'] = '/'.$newLanguage;
        }

        // Replace language code in query parameters
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            if (count($queryParams) > 0) {
                $queryParams['lang'] = $newLanguage;
                $parsedUrl['query'] = http_build_query($queryParams);
            }
        }

        // Reconstruct the modified URL
        $appUrl = config('app.url');
        $appDomain = parse_url($appUrl, PHP_URL_HOST);
        if ($parsedUrl['host'] != $appDomain) {
            $parsedUrl['host'] = $appDomain;
        }
        $modifiedUrl = $parsedUrl['scheme'].'://'.$parsedUrl['host'];
        if (isset($parsedUrl['port'])) {
            $modifiedUrl .= ':'.$parsedUrl['port'];
        }
        if (isset($parsedUrl['path'])) {
            $modifiedUrl .= $parsedUrl['path'];
        }
        if (isset($parsedUrl['query'])) {
            $modifiedUrl .= '?'.$parsedUrl['query'];
        }
        if (isset($parsedUrl['fragment'])) {
            $modifiedUrl .= '#'.$parsedUrl['fragment'];
        }

        return $modifiedUrl;
    }
}
