<?php

namespace Werify\Account\Laravel\Enums\V1\Profile;

use Werify\Account\Laravel\Enums\V1\Enums;

enum Language: string
{
    use Enums;

    case EN = 'en';
    case AR = 'ar';
    case TR = 'tr';
    case RU = 'ru';
    case FR = 'fr';
    case DE = 'de';
    case ES = 'es';
    case IT = 'it';
    case PT = 'pt';
    case ZH = 'zh';
    case JA = 'ja';
    case FA = 'fa';
    case HI = 'hi';
    case BN = 'bn';
    case UR = 'ur';

    public static function languages($lang): string
    {
        if ($lang == 'en') {
            return 'English';
        }
        if ($lang == 'ar') {
            return 'العربية';
        }
        if ($lang == 'tr') {
            return 'Türkçe';
        }
        if ($lang == 'ru') {
            return 'Русский';
        }
        if ($lang == 'fr') {
            return 'Français';
        }
        if ($lang == 'de') {
            return 'Deutsch';
        }
        if ($lang == 'es') {
            return 'Español';
        }
        if ($lang == 'it') {
            return 'Italiano';
        }
        if ($lang == 'pt') {
            return 'Português';
        }
        if ($lang == 'zh') {
            return '中文';
        }
        if ($lang == 'ja') {
            return '日本語';
        }
        if ($lang == 'fa') {
            return 'فارسی';
        }
        if ($lang == 'hi') {
            return 'हिन्दी';
        }
        if ($lang == 'bn') {
            return 'বাংলা';
        }
        if ($lang == 'ur') {
            return 'اردو';
        }

        return 'English';
    }

    // @TODO: Add flags to the languages and return them here

}
