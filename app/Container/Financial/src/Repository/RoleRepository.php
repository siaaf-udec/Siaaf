<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Financial\src\Interfaces\FinancialRoleInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Permissions\Src\Role;

class RoleRepository extends Methods implements FinancialRoleInterface
{
    public function __construct()
    {
        parent::__construct(Role::class);
    }

    /**
     * Return id that identify a role in the database
     *
     * @return mixed
     */
    public function isTeacher()
    {
        return $this->getModel()
                    ->where('name', ConstantRoles::FINANCIAL_TEACHER_ROLE )
                    ->select('id')->get()->first()->id;
    }

    /**
     * Return id that identify a role at the database
     *
     * @return mixed
     */
    public function isStudent()
    {
        return $this->getModel()
            ->where('name', ConstantRoles::FINANCIAL_STUDENT_ROLE )
            ->select('id')->get()->first()->id;
    }

    /**
     * Return id that identify a role at the database
     *
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->getModel()
            ->where('name', ConstantRoles::FINANCIAL_ADMIN_ROLE )
            ->select('id')->get()->first()->id;
    }

    /**
     * Return id that identify a role at the database
     *
     * @return mixed
     */
    public function isSecretary()
    {
        return $this->getModel()
            ->where('name', ConstantRoles::FINANCIAL_SECRETARY_ROLE )
            ->select('id')->get()->first()->id;
    }

    /**
     * Empty method but required
     *
     * @return mixed
     */
    public function process( $model , $request )
    {
        
    }
}