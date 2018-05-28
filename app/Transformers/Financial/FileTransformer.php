<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\File;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    /**
     * @param File $file
     * @return array
     */
    public function transform(File $file)
    {
        return [
            'pk_id'             =>  isset( $file->{ primaryKey() } ) ? $file->{ primaryKey() } : null,
            'file_name'         =>  isset( $file->{ file_name() } ) ? $file->{ file_name() } : null,
            'file_route'        =>  isset( $file->{ file_route() } ) ? $file->{ file_route() } : null,
            'status_fk'         =>  isset( $file->{ status_fk() } ) ? $file->{ status_fk() } : null,
            'user_fk'           =>  isset( $file->{ user_fk() } ) ? $file->{ user_fk() } : null,
            'file_type_fk'      =>  isset( $file->{ file_type_fk() } ) ? $file->{ file_type_fk() } : null,
            'created_at'        =>  isset( $file->{ created_at() } ) ? $file->{ created_at() }->format('Y-m-d H:i:s') : null,
            'updated_at'        =>  isset( $file->{ updated_at() } ) ? $file->{ updated_at() }->format('Y-m-d H:i:s') : null,
            'deleted_at'        =>  isset( $file->{ deleted_at() } ) ? $file->{ deleted_at() }->format('Y-m-d H:i:s') : null,
            'comments_count'    =>  isset( $file->comments_count ) ? $file->comments_count : null,
            'pdf_url'           =>  isset( $file->pdf_url ) ? $file->pdf_url : null,
            'semester'          =>  isset( $file->semester ) ? $file->semester : null,
            'dropzone_status'   =>  isset( $file->dropzone_status ) ? $file->dropzone_status : null,
            'status'            =>  [
                'pk_id'         =>  isset( $file->status->{ primaryKey() } ) ? $file->status->{ primaryKey() } : null,
                'status_name'   =>  isset( $file->status->{ status_name() } ) ? $file->status->{ status_name() } : null,
            ],
            'file_type'         =>  [
                'pk_id'         =>  isset( $file->file_type->{ primaryKey() } ) ? $file->file_type->{ primaryKey() } : null,
                'file_types'    =>  isset( $file->file_type->{ file_types() } ) ? $file->file_type->{ file_types() } : null,
            ],
            'user'              =>  [
                'id'                =>  isset( $file->user->id ) ? $file->user->id : null,
                'name'              =>  isset( $file->user->name ) ? $file->user->name : null,
                'lastname'          =>  isset( $file->user->lastname ) ? $file->user->lastname : null,
                'full_name'         =>  isset( $file->user->full_name ) ? $file->user->full_name : null,
                'profile_picture'   =>  isset( $file->user->profile_picture ) ? $file->user->profile_picture : null,
            ],
            'is_dirty'      =>  $this->addChanges( $file ),
        ];
    }

    /**
     * @param File $file
     * @return mixed
     */
    public function addChanges(File $file )
    {
        $audits = $file->audits()->with('user:id,name,lastname,phone,email')->latest()->get();
        $manager = new Manager;
        $audits = new Collection( $audits, new AuditsTransform );
        return $manager->createData( $audits )->toArray();
    }
}