<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Financial\src\Requests\StatusRequest\StoreStatusRequestsRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
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
        if ( request()->isMethod('GET') )
            return view('financial.management.status.index');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStatusRequestsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusRequestsRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->statusRequestRepository->store( $request ) ) ?
                    jsonResponse() :
                    jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
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
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') ) {
            $status = $this->statusRequestRepository->getModel()->find($id);
            if (isset($status->{status_name()}) && isEditableStatus($status->{status_name()})) {
                return ($this->statusRequestRepository->update($request, $id)) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);
            }
            return jsonResponse('error', 'updated_fail_status', 422);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( request()->isMethod('DELETE') ) {
            $status = $this->statusRequestRepository->getModel()->find($id);
            if (isset($status->{status_name()}) && isEditableStatus($status->{status_name()})) {
                return ($this->statusRequestRepository->destroy($id)) ?
                    jsonResponse('success', 'deleted_done', 200) :
                    jsonResponse('error', 'deleted_fail', 422);
            }

            return jsonResponse('error', 'destroy_fail_status', 422);

        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}