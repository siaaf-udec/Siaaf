<?php

namespace App\Container\Users\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Users\Src\Interfaces\UserInterface;

/*
 * Modelos
 */

use App\Container\Users\Src\User;

class UserRepository extends ControllerRepository implements UserInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    protected function process($user, $data)
    {
        $user['name'] = $data['name'];
        $user['lastname'] = $data['lastname'];
        $user['birthday'] = $data['birthday'];
        $user['identity_type'] = $data['identity_type'];
        $user['identity_no'] = $data['identity_no'];
        $user['identity_expe_place'] = $data['identity_expe_place'];
        $user['identity_expe_date'] = $data['identity_expe_date'];
        $user['address'] = $data['address_create'];
        $user['sexo'] = $data['sexo'];
        $user['phone'] = $data['phone'];
        $user['email'] = $data['email'];
        !empty($data['password']) ? $user['password'] = bcrypt($data['password']): 1;
        $user['state'] = $data['state'];
        $user['cities_id'] = (!isset($data['cities_id']) || empty($data['cities_id'])) ? $data['cities_id'] : 1;
        $user['countries_id'] = (!isset($data['countries_id']) || empty($data['countries_id'])) ? $data['countries_id'] : 1;
        $user['regions_id'] = (!isset($data['regions_id']) || empty($data['regions_id'])) ? $data['regions_id'] : 1;
        $user->save();
        return $user;
    }
}