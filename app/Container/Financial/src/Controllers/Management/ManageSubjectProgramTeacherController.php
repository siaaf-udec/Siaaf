<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\SubjectProgramTeacherRepository;
use App\Container\Financial\src\Requests\SubjectProgramTeacher\StoreSubjectProgramTeacherRequest;
use App\Container\Financial\src\Requests\SubjectProgramTeacher\UpdateSubjectProgramTeacherRequest;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\SubjectProgramTeacherTransform;
use App\Transformers\Financial\SubjectProgramTeacherTransformer;
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
                            ->setTransformer( new SubjectProgramTeacherTransformer )
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