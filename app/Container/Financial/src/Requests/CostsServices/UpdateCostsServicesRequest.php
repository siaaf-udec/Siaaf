<?php

namespace App\Container\Financial\src\Requests\CostsServices;


use Illuminate\Foundation\Http\FormRequest;

class UpdateCostsServicesRequest extends FormRequest
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
        if ( $this->request->has('name') && $this->request->get('name') == 'cost' ) {
            return [
                'value' => 'required|numeric',
            ];
        }
        if ( $this->request->has('name') && $this->request->get('name') == 'cost_valid_until' ) {
            return [
                'value' => 'required|date|after:now',
            ];
        }

        return [
            'cost' => 'required|numeric',
            'service_name' => 'required',
            'valid_until' => 'required|date|after:now',
        ];
    }

    public function messages()
    {
        return [];
    }
}