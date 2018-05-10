<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\Comment;
use League\Fractal\TransformerAbstract;

class CommentsTransformer extends TransformerAbstract
{
    public function transform( Comment $comment )
    {
        return [
            'id'                    =>  isset( $comment->{ primaryKey() } ) ? $comment->{ primaryKey() } : 0,
            'comment'               =>  isset( $comment->{ comment() } ) ? $comment->{ comment() } : null,
            'comment_class'         =>  isset( $comment->{ 'comment_class' } ) ? $comment->{ 'comment_class' } : 'in',
            'created_at'            =>  isset( $comment->{ created_at() } ) ? $comment->{ created_at() }->format('Y-m-d H:i:s') : null,
            'user'                  => [
                'id'                =>  isset( $comment->user->id ) ? $comment->user->id : 0,
                'full_name'         =>  isset( $comment->user->full_name ) ? $comment->user->full_name : 0,
                'profile_picture'   =>  isset( $comment->user->profile_picture ) ? $comment->user->profile_picture : iconHash(),
            ],
        ];
    }
}