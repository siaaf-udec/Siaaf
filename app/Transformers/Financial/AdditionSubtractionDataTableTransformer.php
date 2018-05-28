<?php

namespace App\Transformers\Financial;



use App\Container\Financial\src\AdditionSubtraction;
use League\Fractal\TransformerAbstract;

class AdditionSubtractionDataTableTransformer extends TransformerAbstract
{
    /**
     * @param AdditionSubtraction $additionSubtraction
     * @return array
     */
    public function transform(AdditionSubtraction $additionSubtraction )
    {
        return [
            'id'                =>  isset( $additionSubtraction->{ primaryKey() } ) ? $additionSubtraction->{ primaryKey() } : 0,
            'approval_date'     =>  isset( $additionSubtraction->{ approval_date() } ) ? $additionSubtraction->{ approval_date() }->format('Y-m-d H:i:s ') : null,
            'subject_action'    =>  isset( $additionSubtraction->{ action_subject() } ) ? $additionSubtraction->{ action_subject() } : __('financial.generic.empty'),
            'created_at'        =>  isset( $additionSubtraction->{ created_at() } ) ? $additionSubtraction->{ created_at() }->format('Y-m-d H:i:s') : null,
            'subject_id'        =>  isset( $additionSubtraction->subject->{ primaryKey() } ) ? $additionSubtraction->subject->{ primaryKey() } : 0,
            'subject_code'      =>  isset( $additionSubtraction->subject->{ subject_code() } ) ? $additionSubtraction->subject->{ subject_code() } : 0,
            'subject_name'      =>  isset( $additionSubtraction->subject->{ subject_name() } ) ? $additionSubtraction->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $additionSubtraction->subject->{ subject_credits() } ) ? $additionSubtraction->subject->{ subject_credits() } : 0,
            'program_id'        =>  isset( $additionSubtraction->subject->programs[0]->{ primaryKey() } ) ? $additionSubtraction->subject->programs[0]->{ primaryKey() } : 0,
            'program_name'      =>  isset( $additionSubtraction->subject->programs[0]->{ program_name() } ) ? $additionSubtraction->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'status_name'       =>  isset( $additionSubtraction->status->{ status_name() } ) ? $additionSubtraction->status->{ status_name() } : __('financial.generic.empty'),
            'status_class'      =>  isset( $additionSubtraction->status->class_name ) ? $additionSubtraction->status->class_name : 'default',
            'status_label'      =>  isset( $additionSubtraction->status->status_label ) ? $additionSubtraction->status->status_label : null,
            'teacher_name'      =>  isset( $additionSubtraction->subject->teachers[0]->full_name ) ? $additionSubtraction->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $additionSubtraction->subject->teachers[0]->profile_picture ) ? $additionSubtraction->subject->teachers[0]->profile_picture : iconHash(),
            'teacher_phone'     =>  isset( $additionSubtraction->subject->teachers[0]->phone ) ? $additionSubtraction->subject->teachers[0]->phone : __('financial.generic.empty'),
            'teacher_email'     =>  isset( $additionSubtraction->subject->teachers[0]->email ) ? $additionSubtraction->subject->teachers[0]->email : __('financial.generic.empty'),
            'secretary_name'    =>  isset( $additionSubtraction->secretary->full_name ) ? $additionSubtraction->secretary->full_name : __('financial.generic.empty'),
            'secretary_picture' =>  isset( $additionSubtraction->secretary->profile_picture ) ? $additionSubtraction->secretary->profile_picture : iconHash(),
            'secretary_phone'   =>  isset( $additionSubtraction->secretary->phone ) ? $additionSubtraction->secretary->phone : __('financial.generic.empty'),
            'secretary_email'   =>  isset( $additionSubtraction->secretary->email ) ? $additionSubtraction->secretary->email : __('financial.generic.empty'),
            'student_name'      =>  isset( $additionSubtraction->student->full_name ) ? $additionSubtraction->student->full_name : __('financial.generic.empty'),
            'student_picture'   =>  isset( $additionSubtraction->student->profile_picture ) ? $additionSubtraction->student->profile_picture : iconHash(),
            'student_phone'     =>  isset( $additionSubtraction->student->phone ) ? $additionSubtraction->student->phone : __('financial.generic.empty'),
            'student_email'     =>  isset( $additionSubtraction->student->email ) ? $additionSubtraction->student->email : __('financial.generic.empty'),
            'cost_float'        =>  isset( $additionSubtraction->cost->cost ) ? $additionSubtraction->cost->cost : 0,
            'cost'              =>  isset( $additionSubtraction->cost->cost_to_money ) ? $additionSubtraction->cost->cost_to_money : toMoney( 0 ),
            'total_cost'        =>  isset( $additionSubtraction->total_cost ) ? toMoney( $additionSubtraction->total_cost ) : toMoney( 0 ),
            'comments_count'    =>  isset( $additionSubtraction->comments_count ) ? $additionSubtraction->comments_count : 0,
            'actions'           =>  $this->getActions( $additionSubtraction )
        ];
    }

    /**
     * @param AdditionSubtraction $additionSubtraction
     * @return bool|string
     */
    public function getActions(AdditionSubtraction $additionSubtraction)
    {
        try {
            $edit  = actionLink(
                route('financial.requests.student.add-sub.edit', [ 'id' => $additionSubtraction->{ primaryKey() }]),
                '',
                'fa fa-pencil',
                [ 'data-original-title' => trans('javascript.tooltip.edit') ],
                __('financial.buttons.edit')
            );

            $trash = actionLink(
                'javascript:;',
                'trash',
                'fa fa-trash',
                ['data-id' => $additionSubtraction->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ],
                __('financial.buttons.delete')
            );

            $view = actionLink(
                route('financial.requests.student.add-sub.show', [ 'id' => $additionSubtraction->{ primaryKey() }]),
                '',
                'fa fa-eye',
                [ 'data-original-title' => trans('javascript.tooltip.view') ],
                __('financial.buttons.view')
            );


            $comments = actionLink(
                route('financial.requests.student.add-sub.show', [ 'id' => $additionSubtraction->{ primaryKey() }]),
                '',
                'fa fa-comments',
                [ 'data-original-title' => trans('javascript.tooltip.comments') ],
                trans_choice( 'financial.generic.comments', $additionSubtraction->comments->count(), [ 'num' => $additionSubtraction->comments->count() ] )
            );

            if ( isset( $additionSubtraction->status->{ status_name() } ) ) {
                if ( $additionSubtraction->status->{ status_name() } == 'PENDIENTE' || $additionSubtraction->status->{ status_name() } == 'ENVIADO' ) {
                    return createDropdown( [$view, $edit, $trash, $comments] );
                } elseif ( $additionSubtraction->status->{ status_name() } == 'RECHAZADO' ) {
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