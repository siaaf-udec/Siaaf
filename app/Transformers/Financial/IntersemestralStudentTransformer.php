<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\IntersemestralStudents;
use League\Fractal\TransformerAbstract;

class IntersemestralStudentTransformer extends TransformerAbstract
{
    /**
     * @param IntersemestralStudents $intersemestral
     * @return array
     * @throws \Throwable
     */
    public function transform( IntersemestralStudents $intersemestral )
    {
        return [
            'id'                =>  isset( $intersemestral->{ primaryKey() } ) ? $intersemestral->{ primaryKey() } : 0,
            'intersemestral_id' =>  isset( $intersemestral->{ intersemestral_fk() } ) ? $intersemestral->{ intersemestral_fk() } : 0,
            'paid'              =>  $intersemestral->{ paid() },
            'paid_label'        =>  $intersemestral->{ paid() } ? labelHtml( 'success', 'PAGADO' ) : labelHtml( 'info', 'EN ESPERA DE PAGO' ),
            'student_name'      =>  isset( $intersemestral->student->full_name ) ? $intersemestral->student->full_name : __('financial.generic.empty'),
            'student_picture'   =>  isset( $intersemestral->student->profile_picture ) ? $intersemestral->student->profile_picture : iconHash(),
            'student_phone'     =>  isset( $intersemestral->student->phone ) ? $intersemestral->student->phone : __('financial.generic.empty'),
            'student_email'     =>  isset( $intersemestral->student->email ) ? $intersemestral->student->email : __('financial.generic.empty'),
            'approval_date'     =>  isset( $intersemestral->subscribed->{ approval_date() } ) ? $intersemestral->subscribed->{ approval_date() }->format('Y-m-d H:i:s ') : null,
            'realization_date'  =>  isset( $intersemestral->subscribed->{ realization_date() } ) ? $intersemestral->subscribed->{ realization_date() }->format('Y-m-d H:i:s ') : null,
            'status_name'       =>  isset( $intersemestral->subscribed->status->{ status_name() } ) ? $intersemestral->subscribed->status->{ status_name() } : __('financial.generic.empty'),
            'status_class'      =>  isset( $intersemestral->subscribed->status->class_name ) ? $intersemestral->subscribed->status->class_name : __('financial.generic.empty'),
            'status_label'      =>  isset( $intersemestral->subscribed->status->status_label ) ? $intersemestral->subscribed->status->status_label : __('financial.generic.empty'),
            'created_at'        =>  isset( $intersemestral->subscribed->{ created_at() } ) ? $intersemestral->subscribed->{ created_at() }->format('Y-m-d H:i:s ') : null,
            'subject_code'      =>  isset( $intersemestral->subscribed->subject->{ subject_code() } ) ? $intersemestral->subscribed->subject->{ subject_code() } : 0,
            'subject_name'      =>  isset( $intersemestral->subscribed->subject->{ subject_name() } ) ? $intersemestral->subscribed->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $intersemestral->subscribed->subject->{ subject_credits() } ) ? $intersemestral->subscribed->subject->{ subject_credits() } : 0,
            'program_name'      =>  isset( $intersemestral->subscribed->subject->programs[0]->{ program_name() } ) ? $intersemestral->subscribed->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'teacher_name'      =>  isset( $intersemestral->subscribed->subject->teachers[0]->full_name ) ? $intersemestral->subscribed->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $intersemestral->subscribed->subject->teachers[0]->profile_picture ) ? $intersemestral->subscribed->subject->teachers[0]->profile_picture : iconHash(),
            'teacher_phone'     =>  isset( $intersemestral->subscribed->subject->teachers[0]->phone ) ? $intersemestral->subscribed->subject->teachers[0]->phone : __('financial.generic.empty'),
            'teacher_email'     =>  isset( $intersemestral->subscribed->subject->teachers[0]->email ) ? $intersemestral->subscribed->subject->teachers[0]->email : __('financial.generic.empty'),
            'secretary_name'    =>  isset( $intersemestral->subscribed->secretary->full_name ) ? $intersemestral->subscribed->secretary->full_name : __('financial.generic.empty'),
            'secretary_picture' =>  isset( $intersemestral->subscribed->secretary->profile_picture ) ? $intersemestral->subscribed->secretary->profile_picture : iconHash(),
            'secretary_phone'   =>  isset( $intersemestral->subscribed->secretary->phone ) ? $intersemestral->subscribed->secretary->phone : __('financial.generic.empty'),
            'secretary_email'   =>  isset( $intersemestral->subscribed->secretary->email ) ? $intersemestral->subscribed->secretary->email : __('financial.generic.empty'),
            'cost'              =>  isset( $intersemestral->subscribed->cost->cost_to_money ) ? $intersemestral->subscribed->cost->cost_to_money : toMoney( 0 ),
            'total_cost'        =>  isset( $intersemestral->subscribed->total_cost ) ? toMoney( $intersemestral->subscribed->total_cost ) : toMoney( 0 ),
            'subscribed_count'       =>  isset( $intersemestral->subscribed->subscribed_count ) ? $intersemestral->subscribed->subscribed_count : 0,
            'subscribed_paid_count'  =>  isset( $intersemestral->subscribed->subscribed_paid_count ) ? $intersemestral->subscribed->subscribed_paid_count : 0,
            'subscribed_bar'    =>  isset( $intersemestral->subscribed->subscribed_bar ) ? $intersemestral->subscribed->subscribed_bar : progressBar( minSubscribedIntersemestral(), 0 ),
            'paid_bar'          =>  isset( $intersemestral->subscribed->paid_bar ) ? $intersemestral->subscribed->paid_bar : progressBar( minPaidIntersemestral(), 0),
            'comments_count'    =>  isset( $intersemestral->comments_count ) ? $intersemestral->comments_count : 0,
            'min_paid'          =>  minPaidIntersemestral(),
            'min_subscribed'    =>  minSubscribedIntersemestral(),
            'view'              =>  route('financial.requests.student.intersemestral.show', ['id' => isset( $intersemestral->{ intersemestral_fk() } ) ? $intersemestral->{ intersemestral_fk() } : 0]),
        ];
    }
}