<?php

namespace App\Container\Financial\src\Requests\Cash;


use Illuminate\Foundation\Http\FormRequest;

class PettyCashRequest extends FormRequest
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
            'concept'     => 'required|max:2500',
            'cost'        => 'required|numeric',
            'status'      => 'required|numeric',
            'need_file'   => 'required|boolean',
            'file'        => 'file|mimes:pdf|required_if:need_file,1',
        ];
    }

    public function messages()
    {
        return [];
    }
}