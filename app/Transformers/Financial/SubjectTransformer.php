<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\Subject;
use League\Fractal\TransformerAbstract;

class SubjectTransformer extends TransformerAbstract
{
    /**
     * @param Subject $subject
     * @return array
     */
    public function transform( Subject $subject )
    {
        return [
            'id'                =>  isset( $subject->{ primaryKey() } ) ? $subject->{ primaryKey() } : 0,
            'subject_code'      =>  isset( $subject->{ subject_code() } ) ? $subject->{ subject_code() }  : __('financial.generic.empty'),
            'subject_name'      =>  isset( $subject->{ subject_name() } ) ? $subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $subject->{ subject_credits() } ) ? $subject->{ subject_credits() } : __('financial.generic.empty'),
            'created_at'        =>  isset( $subject->{ created_at() } ) ? $subject->{ created_at() }->format('Y-m-d H:i:s') : null,
            'updated_at'        =>  isset( $subject->{ updated_at() } ) ? $subject->{ updated_at() }->format('Y-m-d H:i:s') : null,
            'deleted_at'        =>  isset( $subject->{ deleted_at() } ) ? $subject->{ deleted_at() }->format('Y-m-d H:i:s') : null,
            'actions'           =>  $this->getActions( $subject ),
        ];
    }

    public function getActions( Subject $subject )
    {
        try {
            $edit  = actionLink(
                'javascript:;',
                'btn btn-icon-only edit yellow',
                'fa fa-pencil',
                ['data-id' => $subject->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ]
            );

            $trash = actionLink(
                'javascript:;',
                'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                'fa fa-trash',
                ['data-id' => $subject->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
            );
            return "$edit $trash";

        } catch ( \Throwable $e ) {
            report( $e );
            return false;
        }
    }
}