<?php

use App\Container\Financial\src\Constants\ConstantStatus;
use App\Container\Financial\src\StatusRequest;
use Illuminate\Database\Seeder;

class StatusFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (ConstantStatus::all() as $status) {
            StatusRequest::create( $status );
        }
    }
}