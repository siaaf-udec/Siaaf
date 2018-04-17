<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialRoleInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Program;

class ProgramRepository extends Methods implements FinancialRoleInterface
{
    /**
     * ProgramRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(Program::class);
    }

    public function assignedTeacher( $id )
    {

    }

    public function process( $model , $request )
    {
        $model->{ program_name() }          =  $request->program;
        return $model->save();
    }
}