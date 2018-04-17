<?php

namespace App\Container\Financial\src\Requests\Requests\Student;


use Illuminate\Foundation\Http\FormRequest;

class IntersemestralStudentRequest extends FormRequest
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
            'program' => 'required|numeric',
            'subject_matter' => 'required|numeric',
            'teacher' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [];
    }
}