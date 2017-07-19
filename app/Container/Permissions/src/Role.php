<?php

namespace App\Container\Permissions\Src;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /*
     * The database connection used by the model.
     *
     * @var string
     * protected $connection = 'developer';
     */
    protected $connection = 'developer';

    public function getNumPermsAttribute(){
        return count($this->perms);
    }
}