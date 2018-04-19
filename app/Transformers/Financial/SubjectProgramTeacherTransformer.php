<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\SubjectProgram;
use League\Fractal\TransformerAbstract;

class SubjectProgramTeacherTransformer extends TransformerAbstract
{
    /**
     * @param SubjectProgram $subjectProgram
     * @return array
     */
    public function transform(SubjectProgram $subjectProgram )
    {
        return [
            'subject_code'      =>  isset( $subjectProgram->subjects[0]->{ subject_code() } ) ? $subjectProgram->subjects[0]->{ subject_code() } : 0,
            'subject_name'      =>  isset( $subjectProgram->subjects[0]->{ subject_name() } ) ? $subjectProgram->subjects[0]->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $subjectProgram->subjects[0]->{ subject_credits() } ) ? $subjectProgram->subjects[0]->{ subject_credits() } : 0,
            'program_name'      =>  isset( $subjectProgram->programs[0]->{ program_name() } ) ? $subjectProgram->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'teacher_name'      =>  isset( $subjectProgram->teachers[0]->full_name ) ? $subjectProgram->teachers[0]->full_name : __('financial.generic.empty'),
            'subject_fk'        =>  isset( $subjectProgram->{ subject_fk() } ) ? $subjectProgram->{ subject_fk() } : 0,
            'program_fk'        =>  isset( $subjectProgram->{ program_fk() } ) ? $subjectProgram->{ program_fk() } : 0,
            'teacher_fk'        =>  isset( $subjectProgram->{ teacher_fk() } ) ? $subjectProgram->{ teacher_fk() } : 0,
            'actions'           =>  $this->getActions( $subjectProgram )
        ];
    }

    public function getActions( SubjectProgram $subjectProgram )
    {
        try {
            $edit  = actionLink(
                'javascript:;',
                'btn btn-icon-only edit yellow',
                'fa fa-pencil',
                [
                    'data-program' => $subjectProgram->{ program_fk() },
                    'data-teacher' => $subjectProgram->{ teacher_fk() },
                    'data-subject' => $subjectProgram->{ subject_fk() },
                    'data-original-title' => trans('javascript.tooltip.edit')
                ]
            );
            $trash = actionLink(
                'javascript:;',
                'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                'fa fa-trash',
                [
                    'data-program' => $subjectProgram->{ program_fk() },
                    'data-teacher' => $subjectProgram->{ teacher_fk() },
                    'data-subject' => $subjectProgram->{ subject_fk() },
                    'data-original-title' => trans('javascript.tooltip.delete')
                ]
            );
            return "$edit $trash";
        } catch ( \Throwable $e ) {
            report( $e );
            return false;
        }
    }
}