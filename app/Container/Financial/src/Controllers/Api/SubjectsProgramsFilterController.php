<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Repository\ProgramRepository;
use App\Container\Financial\src\Repository\SubjectProgramTeacherRepository;
use App\Container\Financial\src\Repository\SubjectRepository;
use App\Container\Financial\src\Repository\UserRepository;
use App\Container\Financial\src\SubjectProgram;
use App\Http\Controllers\Controller;

class SubjectsProgramsFilterController extends Controller
{
    /**
     * @var ProgramRepository
     */
    private $programRepository;
    /**
     * @var SubjectRepository
     */
    private $subjectRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var SubjectProgramTeacherRepository
     */
    private $subjectProgramTeacherRepository;

    /**
     * SubjectsProgramsFilterController constructor.
     * @param ProgramRepository $programRepository
     * @param SubjectRepository $subjectRepository
     * @param SubjectProgramTeacherRepository $subjectProgramTeacherRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ProgramRepository $programRepository,
                                SubjectRepository $subjectRepository,
                                SubjectProgramTeacherRepository $subjectProgramTeacherRepository,
                                UserRepository $userRepository)
    {

        $this->programRepository = $programRepository;
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
        $this->subjectProgramTeacherRepository = $subjectProgramTeacherRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function programs()
    {
        $options = $this->programRepository->options( primaryKey(), program_name());
        return response()->json($options, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function subjects($id)
    {
        /*
        $options = $this->subjectRepository->options(
            primaryKey(),
            subject_name(),
            false,
            true,
            'programs',
            function ($query) use ($id) {
                $query->where( program_fk(), $id);
            }
        );
        */

        $options = $this->subjectRepository->subjectsInProgramAsOptions( $id );

        return response()->json($options, 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function teachers($id)
    {
        $teacher = $this->subjectProgramTeacherRepository->teachersIdsWhereHasSubject( $id );

        $options = $this->userRepository->getModel()
                        ->select('id', 'name', 'lastname')
                        ->whereIn('id', $teacher);

        foreach ($options->cursor() as $option) {
            $items[] = [
                'id'    => $option->id,
                'text'  => $option->full_name
            ];
        }

        return response()->json( ( isset($items) ) ? $items : [] , 200);
    }
}