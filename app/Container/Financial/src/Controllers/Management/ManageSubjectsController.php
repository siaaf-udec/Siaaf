<?php

namespace App\Container\Financial\src\Controllers\Management;



use App\Container\Financial\src\Repository\SubjectRepository;
use App\Container\Financial\src\Requests\Subject\StoreSubjectRequest;
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
        return view('financial.management.subjects.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubjectRequest $request)
    {
        return ( $this->subjectRepository->store( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'processed_fail', 422);
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
        return ( $this->subjectRepository->update($request, $id) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'processed_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ( $this->subjectRepository->destroy( $id ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);
    }
}