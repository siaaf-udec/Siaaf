<?php

namespace App\Container\Permissions\Src;

use Zizaco\Entrust\EntrustRole;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends EntrustRole implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;

    /*
     * The database connection used by the model.
     *
     * @var string
     * protected $connection = 'developer';
     */
    protected $connection = 'developer';

    /**
     * Should the timestamps be audited?
     *
     * @var bool
     */
    protected $auditTimestamps = true;

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'name', 'dysplay_name', 'description',
    ];

    public function getNumPermsAttribute()
    {
        return count($this->perms);
    }
}
