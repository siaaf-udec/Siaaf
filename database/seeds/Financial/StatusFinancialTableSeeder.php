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
        /*
         *  Create status for extension
         */
        foreach (ConstantStatus::extension() as $status) {
            StatusRequest::create( $status );
        }
        /*
         *  Create status for validation
         */
        foreach (ConstantStatus::validation() as $status) {
            StatusRequest::create( $status );
        }
        /*
         *  Create status for additionSubtraction
         */
        foreach (ConstantStatus::additionSubtraction() as $status) {
            StatusRequest::create( $status );
        }
        /*
         *  Create status for file
         */
        foreach (ConstantStatus::file() as $status) {
            StatusRequest::create( $status );
        }
        /*
         *  Create status for intersemestral
         */
        foreach (ConstantStatus::intersemestral() as $status) {
            StatusRequest::create( $status );
        }
    }
}