<?php

namespace Werify\Account\Laravel\Http\Requests\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Werify\Account\Laravel\Enums\V1\Partials\Country;
use Werify\Account\Laravel\Enums\V1\Profile\Currency;
use Werify\Account\Laravel\Enums\V1\Profile\DarkMode;
use Werify\Account\Laravel\Enums\V1\Profile\Language;
use Werify\Account\Laravel\Enums\V1\Profile\Timezone;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'birthday' => 'nullable|date',
            'username' => 'nullable|string',
            'country' => 'nullable|string|in:'.implode(',', array_keys(Country::countries)),
            'language' => 'nullable|string|in:'.implode(',', Language::toArray()),
            'currency' => 'nullable|string|in:'.implode(',', array_keys(Currency::currencies)),
            'timezone' => 'nullable|string|in:'.implode(',', array_keys(Timezone::timezones)),
            'calendar' => 'nullable|string',
            'dark_mode' => 'nullable|int|in:'.implode(',', DarkMode::toArray()),
            'is_public' => 'nullable|boolean',
        ];
    }
}
