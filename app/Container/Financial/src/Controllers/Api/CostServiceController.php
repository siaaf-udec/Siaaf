<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CostServiceRepository;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function valid()
    {
        return response()->json( $this->costServiceRepository->actualCosts(), 200);
    }

    /**
     * Get all service cost form database in datatable format
     *
     * @return mixed
     */
    public function history()
    {
        return $this->costServiceRepository->dataTables()
                        ->setTransformer( new CostServiceTransformer )
                        ->toJson();
    }
}