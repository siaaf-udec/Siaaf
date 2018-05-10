<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\CostServiceRepository;
use App\Container\Financial\src\Requests\CostsServices\StoreCostsServicesRequest;
use App\Container\Financial\src\Requests\CostsServices\UpdateCostsServicesRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ManageCostController extends Controller
{
    /**
     * @var CostServiceRepository
     */
    private $costServiceRepository;

    /**
     * ManageCostController constructor.
     * @param CostServiceRepository $costServiceRepository
     */
    public function __construct(CostServiceRepository $costServiceRepository)
    {
        $this->costServiceRepository = $costServiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.management.costs.index');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCostsServicesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostsServicesRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->costServiceRepository->checkAndSave( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail_cost', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCostsServicesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCostsServicesRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->costServiceRepository->patch($request, $id ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);

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
        if ( request()->isMethod('DELETE') )
            return ( $this->costServiceRepository->destroy( $id ) ) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}