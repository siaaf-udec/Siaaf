<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\CostServiceRepository;
use App\Container\Financial\src\Requests\CostsServices\StoreCostsServicesRequest;
use App\Container\Financial\src\Requests\CostsServices\UpdateCostsServicesRequest;
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
        return view('financial.management.costs.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCostsServicesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostsServicesRequest $request)
    {
        return ( $this->costServiceRepository->store( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'processed_fail', 422);
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
        return ( $this->costServiceRepository->patch($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ( $this->costServiceRepository->destroy( $id ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);
    }
}