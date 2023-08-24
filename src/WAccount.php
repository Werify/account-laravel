<?php

namespace Werify\Account\Laravel;

use Stevebauman\Location\Facades\Location;
use Werify\Account\Laravel\Enums\V1\Profile\Language;

final class WAccount
{
    public static function initializeIndex(string $lang = null)
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

        return self::replaceLanguageInUrl(url()->previous(), $language);
    }

    public static function replaceLanguageInUrl($url, $newLanguage = null)
    {
        if (empty($newLanguage)) {
            return $url;
        }
        $parsedUrl = parse_url($url);

        // Replace language code in path
        if (isset($parsedUrl['path'])) {
            $pathSegments = explode('/', trim($parsedUrl['path'], '/'));
            if (count($pathSegments) > 0) {
                $pathSegments[0] = $newLanguage;
                $parsedUrl['path'] = '/'.implode('/', $pathSegments);
            }
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
