<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Financial\src\Requests\StatusRequest\StoreStatusRequestsRequest;
use App\Http\Controllers\Controller;

class ManageStatusController extends Controller
{
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;

    /**
     * ManageStatusController constructor.
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct(StatusRequestRepository $statusRequestRepository)
    {
        $this->statusRequestRepository = $statusRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.management.status.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStatusRequestsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusRequestsRequest $request)
    {
        return ( $this->statusRequestRepository->store( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreStatusRequestsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStatusRequestsRequest $request, $id)
    {
        $status = $this->statusRequestRepository->getModel()->find( $id );
        if ( isset( $status->{ status_name() } ) && isEditableStatus( $status->{ status_name() }  ) ) {
            return ( $this->statusRequestRepository->update( $request, $id ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);
        }
        return jsonResponse('error', 'updated_fail_status', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->statusRequestRepository->getModel()->find( $id );
        if ( isset( $status->{ status_name() } ) && isEditableStatus( $status->{ status_name() }  ) ) {
            return ($this->statusRequestRepository->destroy($id)) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);
        }

        return jsonResponse('error', 'destroy_fail_status', 422);
    }
}