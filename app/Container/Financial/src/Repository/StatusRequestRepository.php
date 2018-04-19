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
     * Return Status request in a tree format
     *
     * @param $type
     * @return mixed
     */
    public function tree($type )
    {
        return $this->getModel()->where( status_type(), $type );
    }

    /**
     * Return an id of specific status
     *
     * @param $type
     * @param $value
     * @return mixed
     */
    public function getId($type, $value)
    {
        return $this->getModel()->where( status_type(), $type )
                    ->where( status_name(), $value )->select( primaryKey() )->first();
    }

    /**
     * Return the name of an specific status
     *
     * @param $type
     * @return mixed
     */
    public function getNames( $type )
    {
        return $this->getModel()->where( status_type(), $type )
                    ->select( primaryKey(), status_name() )->orderBy(status_name(), 'ASC')->get();
    }

    /**
     * Store a new status
     *
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