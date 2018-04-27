<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialCashInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\PettyCash;
use App\Transformers\Financial\CashTransformer;
use Yajra\DataTables\DataTables;

class CashRepository extends Methods implements FinancialCashInterface
{

    /**
     * CheckRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(PettyCash::class);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return DataTables::of( $this->getModel()->latest() )
                            ->setTransformer( new CashTransformer() )
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
        $model->{ concept() }       =   $request->concept;
        $model->{ cost() }          =   $request->cost;
        $model->{ status() }        =   $request->status;
        $model->{ support() }       =   ( $request->need_file === true ) ? $request->file('file')->store('', 'financial') : null;
        return $model->save();
    }
}