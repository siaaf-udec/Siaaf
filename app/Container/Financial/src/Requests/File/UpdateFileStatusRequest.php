<?php

namespace App\Container\Financial\src\Requests\File;


use Illuminate\Foundation\Http\FormRequest;

class UpdateFileStatusRequest extends FormRequest
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
            'status' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [];
    }
}