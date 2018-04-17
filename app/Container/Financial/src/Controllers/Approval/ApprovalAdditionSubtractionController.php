<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalAdditionSubtractionRequest;
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
        return view('financial.approval.addsub.index');
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
        return ( $this->addSubRepository->updateAdminAddSub($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }
}