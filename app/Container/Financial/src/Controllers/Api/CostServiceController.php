<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\CostService;
use App\Container\Financial\src\Repository\CostServiceRepository;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

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

    public function valid()
    {
        return response()->json( $this->costServiceRepository->actualCosts(), 200);
    }

    public function history()
    {
        return $this->costServiceRepository->dataTables()
                        ->editColumn(cost_service_name(), function ( CostService $costService ) {
                            return ucfirst( trans(strtolower("validation.attributes.{$costService->{cost_service_name()}}") ) );
                        })
                        ->toJson();
    }
}