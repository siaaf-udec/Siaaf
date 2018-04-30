<?php

namespace App\Container\Financial\src\Controllers\Management;



use App\Container\Financial\src\Repository\SubjectRepository;
use App\Container\Financial\src\Requests\Subject\StoreSubjectRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ManageSubjectsController extends Controller
{
    /**
     * @var SubjectRepository
     */
    private $subjectRepository;

    /**
     * ManageSubjectsController constructor.
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.management.subjects.index');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->subjectRepository->store( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSubjectRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubjectRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->subjectRepository->update($request, $id) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( request()->isMethod('DELETE') )
            return ( $this->subjectRepository->destroy( $id ) ) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}