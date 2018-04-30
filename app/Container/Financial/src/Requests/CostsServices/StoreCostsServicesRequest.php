<?php

namespace App\Container\Financial\src\Requests\CostsServices;


use Illuminate\Foundation\Http\FormRequest;

class StoreCostsServicesRequest extends FormRequest
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
            'cost' => 'required|numeric|min:0|max:9999999',
            'service_name' => 'required',
            'valid_until' => 'required|date|after:now',
        ];
    }

    public function messages()
    {
        return [];
    }
}