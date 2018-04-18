<?php

namespace App\Container\Financial\src\Requests\Approval;


use Illuminate\Foundation\Http\FormRequest;

class PaidIntersemestralStatusRequest extends FormRequest
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
            'id'   => 'required|numeric',
            'paid'     => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [];
    }
}