<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Check;
use App\Container\Financial\src\Interfaces\FinancialCheckInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Transformers\Financial\CheckTransformer;
use Yajra\DataTables\DataTables;

class CheckRepository extends Methods implements FinancialCheckInterface
{

    /**
     * CheckRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(Check::class);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return DataTables::of( $this->getModel()->latest() )
                            ->setTransformer( new CheckTransformer )
                            ->toJson();
    }

    /**
     * Store data in database
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request )
    {
        $model->{ check() }         =   $request->check;
        $model->{ pay_to() }        =   $request->pay_to;
        $model->{ status() }        =   $request->status;
        return $model->save();
    }
}