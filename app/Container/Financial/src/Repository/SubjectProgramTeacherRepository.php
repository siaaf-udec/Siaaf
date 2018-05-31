<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialSubjectProgramTeacherInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\SubjectProgram;
use Illuminate\Http\Request;

class SubjectProgramTeacherRepository extends Methods implements FinancialSubjectProgramTeacherInterface
{
    /**
     * SubjectProgramTeacherRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(SubjectProgram::class);
    }

    /**
     * Return subjects where are assigned
     *
     * @return mixed
     */
    public function assignedSubjectsIds()
    {
        return $this->getModel()->select( subject_fk() )->pluck( subject_fk() )->toArray();
    }

    /**
     * Return teachers id where has subjects assigneds
     *
     * @param $id
     * @return mixed
     */
    public function teachersIdsWhereHasSubject( $id )
    {
        return $this->getModel()->where( subject_fk(), $id )
            ->get()->pluck( teacher_fk() )->toArray();
    }

    /**
     * Return assigned subjects with teachers
     *
     * @return mixed
     */
    public function assigned()
    {
        return $this->getModel()->whereHas('subjects', function ($query) {
                        return $query->whereIsCurrent();
                    })
                    ->with('teachers:id,name,lastname', 'programs', 'subjects');
    }

    /**
     * Update the request
     *
     * @param Request $request
     * @return bool|mixed
     */
    public function updateSubjectProgramTeacher(Request $request)
    {
        if ( $request->old_subject ===  $request->subject &&
             $request->old_teacher ===  $request->teacher &&
             $request->old_program ===  $request->program) {
            return true;
        }

        return $this->getModel()->where([
                    [ subject_fk(), $request->old_subject ],
                    [ teacher_fk(), $request->old_teacher ],
                    [ program_fk(), $request->old_program ],
                ])->update([
                    subject_fk() => $request->subject,
                    teacher_fk() => $request->teacher,
                    program_fk() => $request->program,
                ]);
    }

    /**
     * Destroy the request
     *
     * @param Request $request
     * @return bool|mixed
     */
    public function destroySubjectProgramTeacher(Request $request)
    {
        return $this->getModel()->where([
                    [ subject_fk(), $request->subject ],
                    [ teacher_fk(), $request->teacher ],
                    [ program_fk(), $request->program ],
                ])->delete();
    }

    /**
     * Store a new data in database
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request)
    {
        $model->{ subject_fk() }    =   $request->subject;
        $model->{ program_fk() }    =   $request->program;
        $model->{ teacher_fk() }    =   $request->teacher;
        return $model->save();
    }
}