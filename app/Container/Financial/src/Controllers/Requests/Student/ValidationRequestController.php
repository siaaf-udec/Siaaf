<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Financial\src\Requests\Requests\Student\ValidationStudentRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ValidationRequestController extends Controller
{
    /**
     * @var ValidationRepository
     */
    private $validationRepository;

    /**
     * ValidationRequestController constructor.
     * @param ValidationRepository $validationRepository
     */
    public function __construct(ValidationRepository $validationRepository )
    {
        $this->middleware( 'request.status:'.status_type_validation(), ['only' => ['edit'] ] );
        $this->middleware( 'check.available:'.status_type_validation(), ['only' => ['store', 'update', 'destroy'] ] );
        $this->middleware( 'check.cost:'.status_type_validation(), ['only' => ['store'] ] );
        $this->validationRepository = $validationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.validation.index');

        return abort( 405 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.validation.create');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidationStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationStudentRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->validationRepository->storeStudentValidation( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.validation.show', compact('id'));

        return abort( 405 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.validation.edit', compact('id'));

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ValidationStudentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationStudentRequest $request, $id )
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->validationRepository->updateStudentValidation( $request, $id ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( request()->isMethod('DELETE') )
            return ( $this->validationRepository->deleteStudentValidation( $id ) ) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}