<?php

namespace App\Container\Permissions\Src\Repository;


/*
 * Interfaces
 */
use App\Container\Overall\Src\Repository\ControllerRepository;
use App\Container\Permissions\Src\Interfaces\AuditInterface;

/*
 * Modelos
 */
use App\Container\Permissions\Src\Audit;

class AuditRepository extends ControllerRepository implements AuditInterface
{
    public function __construct()
    {
        parent::__construct(Audit::class);
    }

    protected function process($module, $data)
    {
        $module['user_id'] = $data['user_id'];
        $module['user_type'] = $data['user_type'];
        $module->save();
        return $module;
    }
}