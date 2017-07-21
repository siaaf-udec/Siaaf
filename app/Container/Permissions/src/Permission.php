<?php

namespace App\Container\Permissions\Src;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $connection = 'developer';
    /**
     * Get the permission that owns the module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}