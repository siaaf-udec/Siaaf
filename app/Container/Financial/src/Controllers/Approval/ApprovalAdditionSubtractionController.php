<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalAdditionSubtractionRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ApprovalAdditionSubtractionController extends Controller
{
    /**
     * @var AddSubRepository
     */
    private $addSubRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param AddSubRepository $addSubRepository
     */
    public function __construct(AddSubRepository $addSubRepository)
    {
        $this->addSubRepository = $addSubRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.approval.addsub.index');

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApprovalAdditionSubtractionRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApprovalAdditionSubtractionRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->addSubRepository->updateAdminAddSub($request, $id ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }
}