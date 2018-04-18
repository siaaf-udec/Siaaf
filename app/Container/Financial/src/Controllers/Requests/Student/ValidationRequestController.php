<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Financial\src\Requests\Requests\Student\ValidationStudentRequest;
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
        $this->validationRepository = $validationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.requests.student.validation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financial.requests.student.validation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ValidationStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationStudentRequest $request)
    {
        return ( $this->validationRepository->storeStudentValidation( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'processed_fail', 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('financial.requests.student.validation.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        return view('financial.requests.student.validation.edit', compact('id'));
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
        return ( $this->validationRepository->updateStudentValidation( $request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ( $this->validationRepository->deleteStudentValidation( $id ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);

    }
}