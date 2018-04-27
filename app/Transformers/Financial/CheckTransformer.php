<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\Check;
use League\Fractal\TransformerAbstract;

class CheckTransformer extends TransformerAbstract
{
    public function transform( Check $check )
    {
        return [
            'id'            =>  isset( $check->{ primaryKey() } ) ? $check->{ primaryKey() } : 0,
            'check'         =>  isset( $check->{ check() } ) ? $check->{ check() } : 0,
            'pay_to'        =>  isset( $check->{ pay_to() } ) ? $check->{ pay_to() } : __('financial.generic.empty'),
            'status'        =>  isset( $check->{ status() } ) ? $check->{ status() } : 0,
            'status_name'   =>  isset( $check->{ 'status_name' } ) ? $check->{ 'status_name' } : __('financial.generic.empty'),
            'status_class'  =>  isset( $check->{ 'class_name' } ) ? $check->{ 'class_name' } : null,
            'status_label'  =>  isset( $check->{ 'status_label' } ) ? $check->{ 'status_label' } : null,
            'created_at'    =>  isset( $check->{ created_at() } ) ? $check->{ created_at() }->format('Y-m-d H:i:s') : null,
            'updated_at'    =>  isset( $check->{ updated_at() } ) ? $check->{ updated_at() }->format('Y-m-d H:i:s') : null,
            'delivered_at'  =>  isset( $check->{ delivered_at() } ) ? $check->{ delivered_at() }->format('Y-m-d H:i:s') : null,
            'deleted_at'    =>  isset( $check->{ deleted_at() } ) ? $check->{ deleted_at() }->format('Y-m-d H:i:s') : null,
            'actions'       =>  $this->getActions( $check )
        ];
    }

    /**
     * @param Check $check
     * @return bool|string
     */
    public function getActions( Check $check )
    {
        try {

            $edit  = actionLink(
                'javascript:;',
                'btn btn-icon-only edit yellow',
                'fa fa-pencil',
                ['data-id' => $check->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ]
            );

            $trash = actionLink(
                'javascript:;',
                'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                'fa fa-trash',
                ['data-id' => $check->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
            );
            return "$edit $trash";

        } catch ( \Throwable $e ) {
            report( $e );
            return false;
        }
    }
}