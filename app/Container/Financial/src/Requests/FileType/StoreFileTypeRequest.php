<?php

namespace App\Container\Financial\src\Requests\FileType;


use Illuminate\Foundation\Http\FormRequest;

class StoreFileTypeRequest extends FormRequest
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
            'file_type' => 'required|min:2|max:191',
        ];
    }

    public function messages()
    {
        return [];
    }
}