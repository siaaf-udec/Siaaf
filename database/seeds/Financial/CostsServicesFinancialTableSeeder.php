<?php

use App\Container\Financial\src\CostService;
use Illuminate\Database\Seeder;

class CostsServicesFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costs = [
            [
                cost()  =>  0,
                cost_service_name() =>  status_type_extension(),
                cost_valid_until()  =>  today()->addDays( 3 ),
            ],
            [
                cost()  =>  0,
                cost_service_name() =>  status_type_validation(),
                cost_valid_until()  =>  today()->addDays( 3 ),
            ],
            [
                cost()  =>  0,
                cost_service_name() =>  status_type_intersemestral(),
                cost_valid_until()  =>  today()->addDays( 3 ),
            ],
            [
                cost()  =>  0,
                cost_service_name() =>  status_type_addition_subtraction(),
                cost_valid_until()  =>  today()->addDays( 3 ),
            ],
        ];

        foreach ( $costs as $cost ) {
            CostService::create( $cost );
        }
    }
}