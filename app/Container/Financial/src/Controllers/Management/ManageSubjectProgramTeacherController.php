<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\SubjectProgramTeacherRepository;
use App\Container\Financial\src\Requests\SubjectProgramTeacher\StoreSubjectProgramTeacherRequest;
use App\Container\Financial\src\Requests\SubjectProgramTeacher\UpdateSubjectProgramTeacherRequest;
use App\Container\Financial\src\SubjectProgram;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ManageSubjectProgramTeacherController extends Controller
{
    /**
     * @var SubjectProgramTeacherRepository
     */
    private $subjectProgramTeacherRepository;

    /**
     * ManageSubjectProgramTeacherController constructor.
     * @param SubjectProgramTeacherRepository $subjectProgramTeacherRepository
     */
    public function __construct(SubjectProgramTeacherRepository $subjectProgramTeacherRepository)
    {
        $this->subjectProgramTeacherRepository = $subjectProgramTeacherRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        return DataTables::of( $this->subjectProgramTeacherRepository->assigned() )
                            ->addColumn('actions', function (SubjectProgram $subject){
                                $edit  = actionLink(
                                    'javascript:;',
                                    'btn btn-icon-only edit yellow',
                                    'fa fa-pencil',
                                    [
                                        'data-program' => $subject->{ program_fk() },
                                        'data-teacher' => $subject->{ teacher_fk() },
                                        'data-subject' => $subject->{ subject_fk() },
                                        'data-original-title' => trans('javascript.tooltip.edit')
                                    ]
                                );
                                $trash = actionLink(
                                    'javascript:;',
                                    'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                                    'fa fa-trash',
                                    [
                                        'data-program' => $subject->{ program_fk() },
                                        'data-teacher' => $subject->{ teacher_fk() },
                                        'data-subject' => $subject->{ subject_fk() },
                                        'data-original-title' => trans('javascript.tooltip.delete')
                                    ]
                                );
                                return "$edit $trash";
                            })
                            ->rawColumns(['actions'])
                            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectProgramTeacherRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubjectProgramTeacherRequest $request)
    {
        return ( $this->subjectProgramTeacherRepository->store( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubjectProgramTeacherRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSubjectProgramTeacherRequest $request)
    {
        return ( $this->subjectProgramTeacherRepository->updateSubjectProgramTeacher( $request ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StoreSubjectProgramTeacherRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(StoreSubjectProgramTeacherRequest $request)
    {
        return ( $this->subjectProgramTeacherRepository->destroySubjectProgramTeacher( $request ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);
    }
}