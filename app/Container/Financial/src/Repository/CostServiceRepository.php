<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\CostService;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Interfaces\FinancialCostServiceInterface;
use App\Transformers\Financial\CostServiceTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class CostServiceRepository extends Methods implements FinancialCostServiceInterface
{
    /**
     * CostServiceRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(CostService::class);
    }

    public function patch( Request $request, $id )
    {
        $cost = $this->getModel()->find( $id );
        $name = $request->get('name');
        $value = $request->get('value');
        $cost->{ $name } = $value;
        return $cost->save();
    }

    /**
     * @return array
     */
    public function actualCosts()
    {
        $manager = new Manager;
        $costs = $this->getModel()->currentCost()->get();
        $costs = new Collection( $costs, new CostServiceTransformer() );
        return $manager->createData( $costs )->toArray();
    }

    public function getId( $service )
    {
        return $this->getModel()->currentCost()->where( cost_service_name(), $service )->select( primaryKey() )->first();
    }

    /**
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request)
    {
        $model->{ cost() } = $request->cost;
        $model->{ cost_service_name() } = $request->service_name;
        $model->{ cost_valid_until() } = $request->valid_until;
        return $model->save();
    }
}