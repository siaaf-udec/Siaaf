<?php

namespace App\Container\Financial\src\Repository;


use App\Container\Financial\src\Interfaces\FinancialUserInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Users\Src\User;

class UserRepository extends Methods implements FinancialUserInterface
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct( User::class );
        $this->roleRepository = $roleRepository;
    }

    public function isTeacher()
    {
        return $this->whereRole( $this->roleRepository->isTeacher() );
    }

    public function isStudent()
    {
        return $this->whereRole( $this->roleRepository->isStudent() );
    }

    public function isAdmin()
    {
        return $this->whereRole( $this->roleRepository->isAdmin() );
    }

    public function isSecretary()
    {
        return $this->whereRole( $this->roleRepository->isSecretary() );
    }

    public function whereRole($role = null, $relations = [])
    {
        $users = $this->getModel()->whereHas('roles', function ($query) use ($role) {
                        $query->where('role_id', $role);
                 });

        foreach ( $users->cursor() as $user ) {
            $array[] = ( $relations ) ? $user->load( $relations ) : $user;
        }

        return ( isset( $array ) ) ? $array : [] ;
    }

    public function teachersAsOptions()
    {
        $teachers = $this->getModel()->select('id', 'name', 'lastname')->whereHas('roles', function ($query) {
            $query->where('role_id', $this->roleRepository->isTeacher() );
        });

        foreach ( $teachers->cursor() as $teacher ) {
            $array[] = [
                'id'    => isset($teacher->id) ? $teacher->id : 0,
                'text'  => isset($teacher->full_name) ? $teacher->full_name : '',
            ];
        }
        return ( isset( $array ) ) ? $array : [] ;
    }

    public function process($model, $request)
    {
        
    }
}