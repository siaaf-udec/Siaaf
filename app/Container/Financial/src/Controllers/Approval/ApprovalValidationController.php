<?php

namespace App\Container\Financial\src\Controllers\Approval;



use App\Container\Financial\src\Repository\ValidationRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalValidationRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
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
        if ( request()->isMethod('GET') )
            return view('financial.approval.validation.index');

        return abort( 405 );
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
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') ) {
            if ( $this->validationRepository->canUpdateStatus($request, $id) ) {
                return ($this->validationRepository->updateAdminValidation($request, $id)) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);
            }
            return AjaxResponse::make(  'Advertencia',
                "No se puede cambiar el estado de ".approved_status().", ".canceled()." o ".paid_status()." a estados anteriores.", '', 422);
        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }
}