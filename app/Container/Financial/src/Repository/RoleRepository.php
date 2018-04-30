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
        $teacher = $this->getModel()->where('name', teacher_role() )->select('id')->first();
        return isset( $teacher->id ) ? $teacher->id : 0;
    }

    /**
     * Return id that identify a role at the database
     *
     * @return mixed
     */
    public function isStudent()
    {
        $student = $this->getModel()->where('name', student_role() )->select('id')->first();
        return isset($student->id) ? $student->id : 0;
    }

    /**
     * Return id that identify a role at the database
     *
     * @return mixed
     */
    public function isAdmin()
    {
        $admin = $this->getModel()->where('name', admin_role() )->select('id')->first();
        return isset( $admin->id ) ? $admin->id : 0;
    }

    /**
     * Return id that identify a role at the database
     *
     * @return mixed
     */
    public function isSecretary()
    {
        $secretary = $this->getModel()->where('name', secretary_role() )->select('id')->first();
        return isset( $secretary->id ) ? $secretary->id : 0;
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