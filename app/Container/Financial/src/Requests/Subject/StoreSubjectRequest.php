<?php

namespace App\Container\Financial\src\Requests\Subject;


use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'code' => 'required|min:2|max:50',
            'credits' => 'required|numeric|min:1|max:5',
            'subject_matter' => 'required|min:2|max:191',
        ];
    }

    public function messages()
    {
        return [];
    }
}