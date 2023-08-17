<?php
namespace Bulutly\Laravel\Http\Requests\V1\Buluts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'project_id' => 'nullable|uuid',
            'image_id' => 'required|uuid',
            'memory' => 'nullable|integer',
            'cpu' => 'nullable|integer',
            'name' => 'nullable|string',
            'region' => 'nullable|integer',
            'description' => 'nullable|string',
            'auto_scale_cpu' => 'nullable|integer',
            'auto_scale_memory' => 'nullable|integer',
            'tags' => 'nullable|string|max:255',
            'startup_script' => 'nullable|string|max:65535',
        ];
    }


}