<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 11/04/18
 * Time: 9:40 PM
 */

namespace App\Transformers\Financial;


use App\Container\Financial\src\Intersemestral;
use League\Fractal\TransformerAbstract;

class IntersemestralFeedTransformer extends TransformerAbstract
{
    /**
     * @param Intersemestral $intersemestral
     * @return array
     */
    public function transform(Intersemestral $intersemestral )
    {
        return [
            'id'                =>  isset( $intersemestral->{ primaryKey() } ) ? $intersemestral->{ primaryKey() } : 0,
            'status_name'       =>  isset( $intersemestral->status->{ status_name() } ) ? $intersemestral->status->{ status_name() } : __('financial.generic.empty'),
            'status_class'      =>  isset( $intersemestral->status->class_name ) ? $intersemestral->status->class_name : __('financial.generic.empty'),
            'status_label'      =>  isset( $intersemestral->status->status_label ) ? $intersemestral->status->status_label : __('financial.generic.empty'),
            'subject_name'      =>  isset( $intersemestral->subject->{ subject_name() } ) ? $intersemestral->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_code'      =>  isset( $intersemestral->subject->{ subject_code() } ) ? $intersemestral->subject->{ subject_code() } : 0,
            'program_name'      =>  isset( $intersemestral->subject->programs[0]->{ program_name() } ) ? $intersemestral->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'teacher_name'      =>  isset( $intersemestral->subject->teachers[0]->full_name ) ? $intersemestral->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $intersemestral->subject->teachers[0]->profile_picture ) ? $intersemestral->subject->teachers[0]->profile_picture : iconHash(),
            'subscribed_count'       =>  isset( $intersemestral->subscribed_count ) ? $intersemestral->subscribed_count : 0,
            'subscribed_paid_count'  =>  isset( $intersemestral->subscribed_paid_count ) ? $intersemestral->subscribed_paid_count : 0,
            'comments_count'         =>  isset( $intersemestral->comments_count ) ? $intersemestral->comments_count : 0,
            'link'                   => route('financial.requests.student.intersemestral.edit', ['id' => isset( $intersemestral->{ primaryKey() } ) ? $intersemestral->{ primaryKey() } : 0 ]),
        ];
    }
}