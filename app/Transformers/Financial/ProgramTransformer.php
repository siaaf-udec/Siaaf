<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\Program;
use League\Fractal\TransformerAbstract;

class ProgramTransformer extends TransformerAbstract
{
    /**
     * @param Program $program
     * @return array
     */
    public function transform( Program $program )
    {
        return [
            'id'            =>      isset( $program->{ primaryKey() } ) ? $program->{ primaryKey() } : 0,
            'program_name'  =>      isset( $program->{ program_name() } ) ? $program->{ program_name() } : __('financial.generic.empty'),
            'created_at'    =>      isset( $program->{ created_at() } ) ? $program->{ created_at() }->format('Y-m-d H:i:s') : null,
            'actions'       =>      $this->getActions( $program )
        ];
    }

    /**
     * @param Program $program
     * @return bool|string
     */
    public function getActions(Program $program )
    {
        try {
            $edit  = actionLink(
                'javascript:;',
                'edit',
                'fa fa-pencil',
                ['data-id' => $program->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ],
                __('financial.buttons.edit')
            );

            $trash = actionLink(
                'javascript:;',
                'trash',
                'fa fa-trash',
                ['data-id' => $program->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ],
                __('financial.buttons.delete')
            );
            return createDropdown( [$edit, $trash] );

        } catch ( \Throwable $e ) {
            report( $e );
            return false;
        }
    }
}