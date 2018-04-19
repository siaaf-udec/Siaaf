<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\CostService;
use League\Fractal\TransformerAbstract;

class CostServiceTransformer extends TransformerAbstract
{
    /**
     * @param CostService $costService
     * @return array
     */
    public function transform( CostService $costService )
    {
        return [
            'id'                    =>  isset( $costService->{ primaryKey() } ) ? $costService->{ primaryKey() } : 0,
            'cost'                  =>  isset( $costService->{ cost() } ) ? $costService->{ cost() } : 0,
            'cost_service_name'     =>  isset( $costService->{ cost_service_name() } ) ? $costService->{ cost_service_name() } : __('financial.generic.empty'),
            'read_service_name'     =>  isset( $costService->{ cost_service_name() } ) ? ucfirst( trans( strtolower("validation.attributes.{$costService->{cost_service_name()}}") ) ) : __('financial.generic.empty'),
            'cost_valid_until'      =>  isset( $costService->{ cost_valid_until() } ) ? $costService->{ cost_valid_until() }->format('Y-m-d H:i:s') : null,
            'cost_to_money'         =>  isset( $costService->cost_to_money ) ? $costService->cost_to_money : toMoney( 0 ),
        ];
    }
}