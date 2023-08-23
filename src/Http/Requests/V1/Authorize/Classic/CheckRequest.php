<?php

namespace Werify\Account\Laravel\Http\Requests\V1\Authorize\Classic;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
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
            'token' => 'required|string',
        ];
    }
}
