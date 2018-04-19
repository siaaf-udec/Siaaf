<?php

namespace App\Transformers\Financial;


use App\Container\Users\Src\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform( User $user )
    {
        return [
            'id'               =>      isset( $user->id ) ? $user->id : 0,
            'full_name'        =>      isset( $user->full_name ) ? $user->full_name : __('financial.generic.empty'),
            'profile_picture'  =>      isset( $user->profile_picture ) ? $user->profile_picture : null,
            'is_icon'          =>      isset( $user->profile_picture ) ? isIdentIcon( $user->profile_picture ) : null,
            'email'            =>      isset( $user->email ) ? $user->email : __('financial.generic.empty'),
            'phone'            =>      isset( $user->phone ) ? $user->phone : __('financial.generic.empty'),

        ];
    }
}