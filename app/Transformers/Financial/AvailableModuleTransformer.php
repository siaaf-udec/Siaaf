<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\AvailableModules;
use League\Fractal\TransformerAbstract;

class AvailableModuleTransformer extends TransformerAbstract
{
    /**
     * @param AvailableModules $availableModules
     * @return array
     */
    public function transform(AvailableModules $availableModules )
    {
        return [
            'id'                 => isset( $availableModules->{ primaryKey() } ) ? $availableModules->{ primaryKey() } : 0,
            'module_name'        => isset( $availableModules->{ module_name() } ) ? $availableModules->{ module_name() } : __('financial.generic.empty'),
            'module_name_text'   => isset( $availableModules->{ module_name() } ) ? ucfirst( trans( strtolower("validation.attributes.{$availableModules->{module_name()}}") ) ) : __('financial.generic.empty'),
            'available_from'     => isset( $availableModules->{ available_from() } ) ? $availableModules->{ available_from() }->format('Y-m-d H:i:s') : null,
            'available_until'    => isset( $availableModules->{ available_until() } ) ? $availableModules->{ available_until() }->format('Y-m-d H:i:s') : null,
            'created_at'         => isset( $availableModules->{ created_at() } ) ? $availableModules->{ created_at() } : null,
            'updated_at'         => isset( $availableModules->{ updated_at() } ) ? $availableModules->{ updated_at() } : null,
        ];
    }
}