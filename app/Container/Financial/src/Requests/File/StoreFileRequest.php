<?php

namespace App\Container\Financial\src\Requests\File;


use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'file_type' => 'required|numeric',
            'file'      => 'required|file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [];
    }
}