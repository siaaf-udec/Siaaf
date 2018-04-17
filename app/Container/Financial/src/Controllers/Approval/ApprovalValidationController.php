<?php

namespace App\Container\Financial\src\Controllers\Approval;



use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalValidationRequest;
use App\Http\Controllers\Controller;

class ApprovalValidationController extends Controller
{
    /**
     * @var ValidationRepository
     */
    private $validationRepository;


    /**
     * ApprovalValidationController constructor.
     * @param ValidationRepository $validationRepository
     */
    public function __construct( ValidationRepository $validationRepository )
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
        return view('financial.approval.validation.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApprovalValidationRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApprovalValidationRequest $request, $id)
    {
        return ( $this->validationRepository->updateAdminValidation($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }
}