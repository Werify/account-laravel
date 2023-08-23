<?php

namespace Werify\Account\Laravel\Http\Requests\V1\Auth\Classic;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'identifier' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
