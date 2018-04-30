<?php

namespace App\Transformers\Financial;


use App\Container\Financial\src\FileType;
use League\Fractal\TransformerAbstract;

class FileTypeTransformer extends TransformerAbstract
{
    /**
     * @param FileType $fileType
     * @return array
     */
    public function transform(FileType $fileType )
    {
        return [
            'id'            =>  isset( $fileType->{ primaryKey() } ) ? $fileType->{ primaryKey() } : 0,
            'file_types'    =>  isset( $fileType->{ file_types() } ) ? $fileType->{ file_types() } : __('financial.generic.empty'),
            'created_at'    =>  isset( $fileType->{ created_at() } ) ? $fileType->{ created_at() } : null,
            'actions'       =>  $this->getActions( $fileType )
        ];
    }

    /**
     * @param FileType $fileType
     * @return bool|string
     */
    public function getActions(FileType $fileType )
    {
        try {

            $edit  = actionLink(
                'javascript:;',
                'edit',
                'fa fa-pencil',
                ['data-id' => $fileType->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ],
                __('financial.buttons.edit')
            );

            $trash = actionLink(
                'javascript:;',
                'trash',
                'fa fa-trash',
                ['data-id' => $fileType->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ],
                __('financial.buttons.delete')
            );
            return createDropdown( [$edit, $trash] );

        } catch ( \Throwable $e ) {
            report( $e );
            return false;
        }
    }
}