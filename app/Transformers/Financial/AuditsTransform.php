<?php

namespace App\Transformers\Financial;


use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class AuditsTransform extends TransformerAbstract
{
    /**
     * @param object $audit
     * @return array
     * @throws \Throwable
     */
    public function transform($audit)
    {
        return [
            'id'             =>  isset( $audit['id'] )          ? $audit['id'] : 0,
            'event'          =>  isset( $audit['event'] )       ? 'Tipo de evento: '.__("javascript.{$audit['event']}") : null,
            'event_class'    =>  isset( $audit['event'] )       ? htmlClasses( $audit['event'] ) : null,
            'url'            =>  isset( $audit['url'] )         ? $audit['url'] : null,
            'ip_address'     =>  isset( $audit['ip_address'] )  ? $audit['ip_address'] : null,
            'user_agent'     =>  isset( $audit['user_agent'] )  ? $audit['user_agent'] : null,
            'old_value'      =>  isset( $audit['old_values'] )  ? $audit['old_values'] : null,
            'new_value'      =>  isset( $audit['new_values'] )  ? $audit['new_values'] : null,
            'created_at'     =>  isset( $audit['created_at'] )  ? Carbon::parse( $audit['created_at'] )->format('Y-m-d H:i:s') : null,
            'updated_at'     =>  isset( $audit['updated_at'] )  ? Carbon::parse( $audit['updated_at'] )->format('Y-m-d H:i:s') : null,
            'user'           =>  isset( $audit['user']['full_name'] ) ? $audit['user']['full_name'] : null,
            'profile_pic'    =>  isset( $audit['user']['profile_picture'] ) ? $audit['user']['profile_picture'] : null,
            'phone'          =>  isset( $audit['user']['phone'] )     ? $audit['user']['phone'] : null,
            'email'          =>  isset( $audit['user']['email'] )     ? $audit['user']['email'] : null,
        ];
    }
}