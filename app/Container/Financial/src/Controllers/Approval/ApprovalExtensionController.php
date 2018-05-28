<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalExtensionRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ApprovalExtensionController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param ExtensionRepository $extensionRepository
     */
    public function __construct(ExtensionRepository $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.approval.extension.index');

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApprovalExtensionRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApprovalExtensionRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') ) {
            if ( $this->extensionRepository->canUpdateStatus($request, $id) ) {
                return ($this->extensionRepository->updateAdminExtension($request, $id)) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);
            }
            return AjaxResponse::make(  'Advertencia',
                "No se puede cambiar el estado de ".approved_status().", ".canceled()." o ".paid_status()." a estados anteriores.", '', 422);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }
}