<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialSubjectInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Subject;

class SubjectRepository extends Methods implements FinancialSubjectInterface
{
    /**
     * @var SubjectProgramTeacherRepository
     */
    private $subjectProgramTeacherRepository;

    /**
     * SubjectRepository constructor.
     * @param SubjectProgramTeacherRepository $subjectProgramTeacherRepository
     */
    public function __construct(SubjectProgramTeacherRepository $subjectProgramTeacherRepository)
    {
        parent::__construct(Subject::class);
        $this->subjectProgramTeacherRepository = $subjectProgramTeacherRepository;
    }

    /**
     * Return subjects in options format
     *
     * @return mixed
     */
    public function optionsQuery()
    {
        return $this->getModel()
                ->select( primaryKey(), subject_code(), subject_name() );
    }

    /**
     * Return unassigned subjects in options format
     *
     * @return array
     */
    public function subjectsAsOptionsUnassigned()
    {
        $subjects = $this->optionsQuery()
                    ->whereNotIn( primaryKey(), $this->subjectProgramTeacherRepository->assignedSubjectsIds() );

        return $this->subjectOptionsFormatted( $subjects );
    }

    /**
     * Return subjects in options format where has programs assigned
     *
     * @param $programId
     * @return array
     */
    public function subjectsInProgramAsOptions($programId )
    {
        $subjects = $this->optionsQuery()->whereHas('programs', function ($query) use ($programId) {
            $query->where( program_fk(), $programId);
        });

        return $this->subjectOptionsFormatted( $subjects );
    }

    /**
     * Return a formatted data in options
     *
     * @param $subjects
     * @return array
     */
    public function subjectOptionsFormatted($subjects )
    {
        foreach ( $subjects->cursor() as $subject ) {
            $array[] = [
                'id'    =>  $subject->{ primaryKey() },
                'text'  =>  "{$subject->{ subject_code() }} {$subject->{ subject_name() }}"
            ];
        }

        return isset( $array ) ? $array : [];
    }

    /**
     * Update status for options
     * @param $id
     * @return array
     */
    public function subjectsAsOptionsUpdate( $id )
    {
        $subjects = $this->subjectsAsOptionsUnassigned();
        $subject  = $this->get([], $id);
        if ( $subject ) {
            $array[] = [
                'id'    =>  $subject->{ primaryKey() },
                'text'  =>  "{$subject->{ subject_code() }} {$subject->{ subject_name() }}"
            ];
        }
        return isset( $array ) ? array_merge_recursive( $subjects, $array ) : $subjects;
    }

    /**
     * Store a new data
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request){
        $model->{ subject_code() }      = $request->code;
        $model->{ subject_credits() }   = $request->credits;
        $model->{ subject_name() }      = $request->subject_matter;
        return $model->save();
    }
}