<?php

namespace App\Transformers\Financial;

use App\Container\Financial\src\Intersemestral;
use League\Fractal\TransformerAbstract;

class IntersemestralTransformer extends TransformerAbstract
{
    /**
     * @param Intersemestral $intersemestral
     * @return array
     * @throws \Throwable
     */
    public function transform( Intersemestral $intersemestral )
    {
        $subscribers = [];

        foreach ( $intersemestral->subscribed as $subscribed ) {
            $subscribers[] = [
                'id'                =>  isset( $subscribed->{ primaryKey() } ) ? $subscribed->{ primaryKey() } : 0,
                'student_name'      =>  isset( $subscribed->student->full_name ) ? $subscribed->student->full_name : __('financial.generic.empty'),
                'student_picture'   =>  isset( $subscribed->student->profile_picture ) ? $subscribed->student->profile_picture : iconHash(),
                'student_phone'     =>  isset( $subscribed->student->phone ) ? $subscribed->student->phone : __('financial.generic.empty'),
                'student_email'     =>  isset( $subscribed->student->email ) ? $subscribed->student->email : __('financial.generic.empty'),
                'paid'              =>  $subscribed->{ paid() },
                'paid_label'        =>  $subscribed->{ paid() } ? labelHtml( 'success', 'PAGADO' ) : labelHtml( 'info', 'EN ESPERA DE PAGO' ),
            ];
        }

        return [

            'id'                =>  isset( $intersemestral->{ primaryKey() } ) ? $intersemestral->{ primaryKey() } : 0,
            'approval_date'     =>  isset( $intersemestral->{ approval_date() } ) ? $intersemestral->{ approval_date() }->format('Y-m-d H:i:s ') : null,
            'realization_date'  =>  isset( $intersemestral->{ realization_date() } ) ? $intersemestral->{ realization_date() }->format('Y-m-d H:i:s ') : null,
            'status_name'       =>  isset( $intersemestral->status->{ status_name() } ) ? $intersemestral->status->{ status_name() } : __('financial.generic.empty'),
            'status_class'      =>  isset( $intersemestral->status->class_name ) ? $intersemestral->status->class_name : __('financial.generic.empty'),
            'status_label'      =>  isset( $intersemestral->status->status_label ) ? $intersemestral->status->status_label : __('financial.generic.empty'),
            'created_at'        =>  isset( $intersemestral->{ created_at() } ) ? $intersemestral->{ created_at() }->format('Y-m-d H:i:s ') : null,
            'subject_code'      =>  isset( $intersemestral->subject->{ subject_code() } ) ? $intersemestral->subject->{ subject_code() } : 0,
            'subject_name'      =>  isset( $intersemestral->subject->{ subject_name() } ) ? $intersemestral->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $intersemestral->subject->{ subject_credits() } ) ? $intersemestral->subject->{ subject_credits() } : 0,
            'program_name'      =>  isset( $intersemestral->subject->programs[0]->{ program_name() } ) ? $intersemestral->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'teacher_name'      =>  isset( $intersemestral->subject->teachers[0]->full_name ) ? $intersemestral->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $intersemestral->subject->teachers[0]->profile_picture ) ? $intersemestral->subject->teachers[0]->profile_picture : iconHash(),
            'teacher_phone'     =>  isset( $intersemestral->subject->teachers[0]->phone ) ? $intersemestral->subject->teachers[0]->phone : __('financial.generic.empty'),
            'teacher_email'     =>  isset( $intersemestral->subject->teachers[0]->email ) ? $intersemestral->subject->teachers[0]->email : __('financial.generic.empty'),
            'secretary_name'    =>  isset( $intersemestral->secretary->full_name ) ? $intersemestral->secretary->full_name : __('financial.generic.empty'),
            'secretary_picture' =>  isset( $intersemestral->secretary->profile_picture ) ? $intersemestral->secretary->profile_picture : iconHash(),
            'secretary_phone'   =>  isset( $intersemestral->secretary->phone ) ? $intersemestral->secretary->phone : __('financial.generic.empty'),
            'secretary_email'   =>  isset( $intersemestral->secretary->email ) ? $intersemestral->secretary->email : __('financial.generic.empty'),
            'cost'              =>  isset( $intersemestral->cost->cost_to_money ) ? $intersemestral->cost->cost_to_money : toMoney( 0 ),
            'total_cost'        =>  isset( $intersemestral->total_cost ) ? toMoney( $intersemestral->total_cost ) : toMoney( 0 ),
            'subscribed_count'       =>  isset( $intersemestral->subscribed_count ) ? $intersemestral->subscribed_count : 0,
            'subscribed_paid_count'  =>  isset( $intersemestral->subscribed_paid_count ) ? $intersemestral->subscribed_paid_count : 0,
            'subscribed_bar'    =>  isset( $intersemestral_bar ) ? $intersemestral_bar : progressBar( minSubscribedIntersemestral(), 0 ),
            'paid_bar'          =>  isset( $intersemestral->paid_bar ) ? $intersemestral->paid_bar : progressBar( minPaidIntersemestral(), 0),
            'min_subscribed'    => minSubscribedIntersemestral(),
            'min_paid'          => minPaidIntersemestral(),
            'comments_count'    =>  isset( $intersemestral->comments_count ) ? $intersemestral->comments_count : 0,
            'subscribed'        => $subscribers,
        ];
    }
}