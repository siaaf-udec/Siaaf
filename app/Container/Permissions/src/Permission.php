<?php

namespace App\Container\Permissions\Src;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'developer';

}