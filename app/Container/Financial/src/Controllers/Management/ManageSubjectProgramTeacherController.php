<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\SubjectProgramTeacherRepository;
use App\Container\Financial\src\Requests\SubjectProgramTeacher\StoreSubjectProgramTeacherRequest;
use App\Container\Financial\src\Requests\SubjectProgramTeacher\UpdateSubjectProgramTeacherRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
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
        if ( request()->isMethod('GET') )
            return DataTables::of( $this->subjectProgramTeacherRepository->assigned() )
                                ->setTransformer( new SubjectProgramTeacherTransformer )
                                ->toJson();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectProgramTeacherRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectProgramTeacherRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->subjectProgramTeacherRepository->store( $request ) ) ?
                    jsonResponse() :
                    jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubjectProgramTeacherRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectProgramTeacherRequest $request)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->subjectProgramTeacherRepository->updateSubjectProgramTeacher( $request ) ) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StoreSubjectProgramTeacherRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreSubjectProgramTeacherRequest $request)
    {
        if ( request()->isMethod('DELETE') )
            return ( $this->subjectProgramTeacherRepository->destroySubjectProgramTeacher( $request ) ) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}