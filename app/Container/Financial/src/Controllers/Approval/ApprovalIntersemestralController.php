<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalIntersemestralRequest;
use App\Container\Financial\src\Requests\Approval\PaidIntersemestralStatusRequest;
use App\Http\Controllers\Controller;

class ApprovalIntersemestralController extends Controller
{
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param IntersemestralRepository $intersemestralRepository
     */
    public function __construct(IntersemestralRepository $intersemestralRepository)
    {
        $this->intersemestralRepository = $intersemestralRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.approval.intersemestral.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApprovalIntersemestralRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApprovalIntersemestralRequest $request, $id)
    {
        return ( $this->intersemestralRepository->updateAdminIntersemestral($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }

    /**
     * Store a paid status resource in storage.
     *
     * @param PaidIntersemestralStatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaidIntersemestralStatusRequest $request)
    {
        return ( $this->intersemestralRepository->paid( $request ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }
}