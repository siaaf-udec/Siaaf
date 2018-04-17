<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\SubjectProgram;
use League\Fractal\TransformerAbstract;

class SubjectProgramTransformer extends TransformerAbstract
{
    /**
     * @param SubjectProgram $subjectProgram
     * @return array
     */
    public function transform( SubjectProgram $subjectProgram )
    {
        return [
            'subject_fk'    =>  isset( $subjectProgram->{ subject_fk() } ) ? $subjectProgram->{ subject_fk() } : 0,
            'program_fk'    =>  isset( $subjectProgram->{ program_fk() } ) ? $subjectProgram->{ program_fk() } : 0,
            'teacher_fk'    =>  isset( $subjectProgram->{ teacher_fk() } ) ? $subjectProgram->{ teacher_fk() } : 0,
        ];
    }
}