<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\Extension;
use League\Fractal\TransformerAbstract;

class ExtensionTransformer extends TransformerAbstract
{
    /**
     * @param Extension $extension
     * @return array
     */
    public function transform( Extension $extension )
    {
        return [
            'id'                =>  isset( $extension->{ primaryKey() } ) ? $extension->{ primaryKey() } : 0,
            'approval_date'     =>  isset( $extension->{ approval_date() } ) ? $extension->{ approval_date() }->format('Y-m-d H:i:s') : null,
            'realization_date'  =>  isset( $extension->{ realization_date() } ) ? $extension->{ realization_date() }->format('Y-m-d H:i:s') : null,
            'created_at'        =>  isset( $extension->{ created_at() } ) ? $extension->{ created_at() }->format('Y-m-d H:i:s') : null,
            'subject_code'      =>  isset( $extension->subject->{ subject_code() } ) ? $extension->subject->{ subject_code() } : 0,
            'subject_name'      =>  isset( $extension->subject->{ subject_name() } ) ? $extension->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $extension->subject->{ subject_credits() } ) ? $extension->subject->{ subject_credits() } : 0,
            'program_name'      =>  isset( $extension->subject->programs[0]->{ program_name() } ) ? $extension->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'status_name'       =>  isset( $extension->status->{ status_name() } ) ? $extension->status->{ status_name() } : __('financial.generic.empty'),
            'status_class'      =>  isset( $extension->status->class_name ) ? $extension->status->class_name : __('financial.generic.empty'),
            'status_label'      =>  isset( $extension->status->status_label ) ? $extension->status->status_label : __('financial.generic.empty'),
            'teacher_name'      =>  isset( $extension->subject->teachers[0]->full_name ) ? $extension->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $extension->subject->teachers[0]->profile_picture ) ? $extension->subject->teachers[0]->profile_picture : iconHash(),
            'teacher_phone'     =>  isset( $extension->subject->teachers[0]->phone ) ? $extension->subject->teachers[0]->phone : __('financial.generic.empty'),
            'teacher_email'     =>  isset( $extension->subject->teachers[0]->email ) ? $extension->subject->teachers[0]->email : __('financial.generic.empty'),
            'secretary_name'    =>  isset( $extension->secretary->full_name ) ? $extension->secretary->full_name : __('financial.generic.empty'),
            'secretary_picture' =>  isset( $extension->secretary->profile_picture ) ? $extension->secretary->profile_picture : iconHash(),
            'secretary_phone'   =>  isset( $extension->secretary->phone ) ? $extension->secretary->phone : __('financial.generic.empty'),
            'secretary_email'   =>  isset( $extension->secretary->email ) ? $extension->secretary->email : __('financial.generic.empty'),
            'student_name'      =>  isset( $extension->student->full_name ) ? $extension->student->full_name : __('financial.generic.empty'),
            'student_picture'   =>  isset( $extension->student->profile_picture ) ? $extension->student->profile_picture : iconHash(),
            'student_phone'     =>  isset( $extension->student->phone ) ? $extension->student->phone : __('financial.generic.empty'),
            'student_email'     =>  isset( $extension->student->email ) ? $extension->student->email : __('financial.generic.empty'),
            'cost'              =>  isset( $extension->cost->cost_to_money ) ? $extension->cost->cost_to_money : toMoney( 0 ),
            'total_cost'        =>  isset( $extension->total_cost ) ? toMoney( $extension->total_cost ) : toMoney( 0 ),
            'comments_count'    =>  isset( $extension->comments_count ) ? $extension->comments_count : 0,
            'actions'           =>  $this->getActions( $extension ),
        ];
    }

    public function getActions( Extension $extension )
    {
        try {
            $edit  = actionLink(
                route('financial.requests.student.extension.edit', [ 'id' => $extension->{ primaryKey() }]),
                '',
                'fa fa-pencil',
                [ 'data-original-title' => trans('javascript.tooltip.edit') ],
                __('financial.buttons.edit')
            );

            $trash = actionLink(
                'javascript:;',
                'trash',
                'fa fa-trash',
                ['data-id' => $extension->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ],
                __('financial.buttons.delete')
            );

            $view = actionLink(
                route('financial.requests.student.extension.show', [ 'id' => $extension->{ primaryKey() }]),
                '',
                'fa fa-eye',
                [ 'data-original-title' => trans('javascript.tooltip.view') ],
                __('financial.buttons.view')
            );


            $comments = actionLink(
                route('financial.requests.student.extension.show', [ 'id' => $extension->{ primaryKey() }]),
                '',
                'fa fa-comments',
                [ 'data-original-title' => trans('javascript.tooltip.comments') ],
                trans_choice( 'financial.generic.comments', $extension->comments->count(), [ 'num' => $extension->comments->count() ] )
            );

            if ( isset( $extension->status->{ status_name() } ) ) {
                if ( $extension->status->{ status_name() } == pending_status() || $extension->status->{ status_name() } == sent_status() ) {
                    return createDropdown( [$view, $edit, $trash, $comments] );
                } elseif ( $extension->status->{ status_name() } == rejected_status() ) {
                    return createDropdown( [$view, $edit, $comments] );
                } else {
                    return createDropdown( [$view, $comments] );
                }
            }
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }
}