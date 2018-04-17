<?php

namespace App\Container\Financial\src\Requests\StatusRequest;


use Illuminate\Foundation\Http\FormRequest;

class StoreStatusRequestsRequest extends FormRequest
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
            'status_name' => 'required|min:2|max:191',
            'status_type' => 'required|min:2|max:191',
        ];
    }

    public function messages()
    {
        return [];
    }
}