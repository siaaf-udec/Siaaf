<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\CostService;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Interfaces\FinancialCostServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $costs = $this->getModel()->currentCost()->get();

        if ( $costs ) {
            foreach ($costs as $cost) {
                $array[] = [
                    'id'                => isset( $cost->{ primaryKey() } ) ? $cost->{ primaryKey() } : 0,
                    'cost'              => isset( $cost->{ cost() } ) ? $cost->{ cost() } : 0,
                    'cost_to_money'     => isset( $cost->{ 'cost_to_money' } ) ? $cost->{ 'cost_to_money' } : '$0',
                    'cost_service_name' => isset( $cost->{ cost_service_name() } ) ? $cost->{ cost_service_name() } : trans('financial.generic.empty'),
                    'cost_valid_until'  => isset( $cost->{ cost_valid_until() } ) ? $cost->{ cost_valid_until() } : today(),
                ];
            }
        }

        return isset( $array ) ? $array : [];
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