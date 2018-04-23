<?php

namespace App\Container\Financial\src\Requests\AvailableModule;


use Illuminate\Foundation\Http\FormRequest;

class AvailableModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'module_name'       => 'required|max:191',
            'available_from'    => 'required|date',
            'available_until'   => 'required|date|after:available_from',
        ];
    }

    public function messages()
    {
        return [];
    }
}