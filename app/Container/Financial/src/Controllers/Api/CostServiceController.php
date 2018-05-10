<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CostServiceRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\CostServiceTransformer;

class CostServiceController extends Controller
{
    /**
     * @var CostServiceRepository
     */
    private $costServiceRepository;

    /**
     * CostServiceController constructor.
     * @param CostServiceRepository $costServiceRepository
     */
    public function __construct(CostServiceRepository $costServiceRepository)
    {
        $this->costServiceRepository = $costServiceRepository;
    }

    /**
     * Return current available cost
     *
     * @return \Illuminate\Http\Response
     */
    public function valid()
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->costServiceRepository->actualCosts(), 200);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get all service cost form database in datatable format
     *
     * @return mixed
     */
    public function history()
    {
        if ( request()->isMethod('GET') )
            return $this->costServiceRepository->dataTables()
                            ->setTransformer( new CostServiceTransformer )
                            ->toJson();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}