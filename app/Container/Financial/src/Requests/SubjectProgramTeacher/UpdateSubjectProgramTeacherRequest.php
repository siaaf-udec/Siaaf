<?php

namespace App\Container\Financial\src\Requests\SubjectProgramTeacher;


use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectProgramTeacherRequest extends FormRequest
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
            'subject' => 'required|numeric',
            'old_subject' => 'required|numeric',
            'teacher' => 'required|numeric',
            'old_teacher' => 'required|numeric',
            'program' => 'required|numeric',
            'old_program' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [];
    }
}