<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Financial\src\Repository\ProgramRepository;
use App\Container\Financial\src\Repository\SubjectProgramTeacherRepository;
use App\Container\Financial\src\Repository\SubjectRepository;
use App\Container\Financial\src\Repository\UserRepository;
use App\Container\Financial\src\SubjectProgram;
use App\Container\Overall\Src\Facades\AjaxResponse;
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
     * Get a list of programs in options format
     *
     * @return \Illuminate\Http\Response
     */
    public function programs()
    {
        if ( request()->isMethod('GET') ) {
            $options = $this->programRepository->options(primaryKey(), program_name());
            return response()->json($options, 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get a list of subjects in options format
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function subjects($id)
    {
        if ( request()->isMethod('GET') ) {
            $options = $this->subjectRepository->subjectsInProgramAsOptions($id);
            return response()->json($options, 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get a list of teachers where has assigned subjects in options format
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function teachers($id)
    {
        if ( request()->isMethod('GET') ) {
            $teacher = $this->subjectProgramTeacherRepository->teachersIdsWhereHasSubject($id);

            $options = $this->userRepository->getModel()
                ->select('id', 'name', 'lastname')
                ->whereIn('id', $teacher);

            foreach ($options->cursor() as $option) {
                $items[] = [
                    'id' => $option->id,
                    'text' => $option->full_name
                ];
            }

            return response()->json((isset($items)) ? $items : [], 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}