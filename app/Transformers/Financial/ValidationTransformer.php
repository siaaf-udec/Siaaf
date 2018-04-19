<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\Validation;
use League\Fractal\TransformerAbstract;

class ValidationTransformer extends TransformerAbstract
{
    /**
     * @param Validation $validation
     * @return array
     */
    public function transform(Validation $validation )
    {
        return [
            'id'                =>  isset( $validation->{ primaryKey() } ) ? $validation->{ primaryKey() } : 0,
            'approval_date'     =>  isset( $validation->{ approval_date() } ) ? $validation->{ approval_date() }->format('Y-m-d H:i:s ') : null,
            'realization_date'  =>  isset( $validation->{ realization_date() } ) ? $validation->{ realization_date() }->format('Y-m-d H:i:s ') : null,
            'created_at'        =>  isset( $validation->{ created_at() } ) ? $validation->{ created_at() }->format('Y-m-d H:i:s ') : null,
            'subject_code'      =>  isset( $validation->subject->{ subject_code() } ) ? $validation->subject->{ subject_code() } : 0,
            'subject_name'      =>  isset( $validation->subject->{ subject_name() } ) ? $validation->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $validation->subject->{ subject_credits() } ) ? $validation->subject->{ subject_credits() } : 0,
            'program_name'      =>  isset( $validation->subject->programs[0]->{ program_name() } ) ? $validation->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),

            'status_name'       =>  isset( $validation->status->{ status_name() } ) ? $validation->status->{ status_name() } : __('financial.generic.empty'),
            'status_label'      =>  isset( $validation->status->status_label ) ? $validation->status->status_label : null,
            'status_class'      =>  isset( $validation->status->status_class ) ? $validation->status->status_class : 'default',

            'teacher_name'      =>  isset( $validation->subject->teachers[0]->full_name ) ? $validation->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $validation->subject->teachers[0]->profile_picture ) ? $validation->subject->teachers[0]->profile_picture : iconHash(),
            'teacher_phone'     =>  isset( $validation->subject->teachers[0]->phone ) ? $validation->subject->teachers[0]->phone : __('financial.generic.empty'),
            'teacher_email'     =>  isset( $validation->subject->teachers[0]->email ) ? $validation->subject->teachers[0]->email : __('financial.generic.empty'),
            'secretary_name'    =>  isset( $validation->secretary->full_name ) ? $validation->secretary->full_name : __('financial.generic.empty'),
            'secretary_picture' =>  isset( $validation->secretary->profile_picture ) ? $validation->secretary->profile_picture : iconHash(),
            'secretary_phone'   =>  isset( $validation->secretary->phone ) ? $validation->secretary->phone : __('financial.generic.empty'),
            'secretary_email'   =>  isset( $validation->secretary->email ) ? $validation->secretary->email : __('financial.generic.empty'),
            'student_name'      =>  isset( $validation->student->full_name ) ? $validation->student->full_name : __('financial.generic.empty'),
            'student_picture'   =>  isset( $validation->student->profile_picture ) ? $validation->student->profile_picture : iconHash(),
            'student_phone'     =>  isset( $validation->student->phone ) ? $validation->student->phone : __('financial.generic.empty'),
            'student_email'     =>  isset( $validation->student->email ) ? $validation->student->email : __('financial.generic.empty'),
            'cost'              =>  isset( $validation->cost->cost_to_money ) ? $validation->cost->cost_to_money : toMoney( 0 ),
            'total_cost'        =>  isset( $validation->total_cost ) ? toMoney( $validation->total_cost ) : toMoney( 0 ),
            'comments_count'    =>  isset( $validation->comments_count ) ? $validation->comments_count : 0,
            'actions'           =>  $this->getActions( $validation )
        ];
    }

    /**
     * @param Validation $validation
     * @return bool|string
     */
    public function getActions(Validation $validation)
    {
        try {
            $edit  = actionLink(
                route('financial.requests.student.validation.edit', [ 'id' => $validation->{ primaryKey() }]),
                'btn btn-icon-only yellow',
                'fa fa-pencil',
                [ 'data-original-title' => trans('javascript.tooltip.edit') ]
            );

            $trash = actionLink(
                'javascript:;',
                'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                'fa fa-trash',
                ['data-id' => $validation->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
            );

            $view = actionLink(
                route('financial.requests.student.validation.show', [ 'id' => $validation->{ primaryKey() }]),
                'btn btn-icon-only green',
                'fa fa-eye',
                [ 'data-original-title' => trans('javascript.tooltip.view') ]
            );


            $comments = actionLink(
                route('financial.requests.student.validation.show', [ 'id' => $validation->{ primaryKey() }]),
                'btn btn-icon-only blue',
                'fa fa-comments',
                [ 'data-original-title' => trans('javascript.tooltip.comments') ],
                $validation->comments->count()
            );

            if ( isset( $validation->status->{ status_name() } ) ) {
                if ( $validation->status->{ status_name() } == 'PENDIENTE' || $validation->status->{ status_name() } == 'ENVIADO' ) {
                    return $view.' '.$edit.' '.$trash.' '.$comments;
                } elseif ( $validation->status->{ status_name() } == 'RECHAZADO' ) {
                    return $view.' '.$edit.' '.$comments;
                } else {
                    return $view.' '.$comments;
                }
            }
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }
}