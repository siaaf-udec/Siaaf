<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\PettyCash;
use League\Fractal\TransformerAbstract;

class CashTransformer extends TransformerAbstract
{
    public function transform( PettyCash $pettyCash )
    {
        return [
            'id'            =>  isset( $pettyCash->{ primaryKey() } ) ? $pettyCash->{ primaryKey() } : 0,
            'concept'       =>  isset( $pettyCash->{ concept() } ) ? $pettyCash->{ concept() } : __('financial.generic.empty'),
            'cost'          =>  isset( $pettyCash->{ cost() } ) ? $pettyCash->{ cost() } : 0,
            'cost_to_money' =>  isset( $pettyCash->cost_to_money ) ? $pettyCash->cost_to_money : toMoney( 0 ),
            'status'        =>  isset( $pettyCash->{ status() } ) ? $pettyCash->{ status() } : 0,
            'status_name'   =>  isset( $pettyCash->{ 'status_name' } ) ? $pettyCash->{ 'status_name' } : __('financial.generic.empty'),
            'status_class'  =>  isset( $pettyCash->{ 'class_name' } ) ? $pettyCash->{ 'class_name' } : null,
            'status_label'  =>  isset( $pettyCash->{ 'status_label' } ) ? $pettyCash->{ 'status_label' } : null,
            'pdf_url'       =>  isset( $pettyCash->pdf_url ) ? $pettyCash->pdf_url : null,
            'created_at'    =>  isset( $pettyCash->{ created_at() } ) ? $pettyCash->{ created_at() }->format('Y-m-d H:i:s') : null,
            'updated_at'    =>  isset( $pettyCash->{ updated_at() } ) ? $pettyCash->{ updated_at() }->format('Y-m-d H:i:s') : null,
            'deleted_at'    =>  isset( $pettyCash->{ deleted_at() } ) ? $pettyCash->{ deleted_at() }->format('Y-m-d H:i:s') : null,
            'actions'       =>  $this->getActions( $pettyCash )
        ];
    }

    /**
     * @param PettyCash $pettyCash
     * @return bool|string
     */
    public function getActions( PettyCash $pettyCash )
    {
        try {

            $edit  = actionLink(
                'javascript:;',
                'btn btn-icon-only edit yellow',
                'fa fa-pencil',
                ['data-id' => $pettyCash->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ]
            );

            $trash = actionLink(
                'javascript:;',
                'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                'fa fa-trash',
                ['data-id' => $pettyCash->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
            );
            return "$edit $trash";

        } catch ( \Throwable $e ) {
            report( $e );
            return false;
        }
    }
}