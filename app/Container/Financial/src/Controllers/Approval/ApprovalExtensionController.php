<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalExtensionRequest;
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
        return view('financial.approval.extension.index');
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
        return ( $this->extensionRepository->updateAdminExtension($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }
}