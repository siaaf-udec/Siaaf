<?php

namespace App\Container\Financial\src\Repository;

use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Interfaces\FinancialStatusRequestInterface;
use App\Container\Financial\src\StatusRequest;

class StatusRequestRepository extends Methods implements FinancialStatusRequestInterface
{
    /**
     * StatusRequestInterfaceRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(StatusRequest::class);
    }

    /**
     * @param $type
     * @return mixed
     */
    public function tree($type )
    {
        return $this->getModel()->where( status_type(), $type );
    }

    public function getId($type, $value)
    {
        return $this->getModel()->where( status_type(), $type )
                    ->where( status_name(), $value )->select( primaryKey() )->first();
    }

    public function getNames( $type )
    {
        return $this->getModel()->where( status_type(), $type )
                    ->select( primaryKey(), status_name() )->orderBy(status_name(), 'ASC')->get();
    }

    /**
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request)
    {
        $model->{ status_name() } = $request->status_name;
        $model->{ status_type() } = $request->status_type;
        return $model->save();
    }
}