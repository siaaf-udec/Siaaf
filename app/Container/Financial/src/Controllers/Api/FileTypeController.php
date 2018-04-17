<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\FileType;
use App\Container\Financial\src\Repository\FileTypeRepository;
use App\Http\Controllers\Controller;

class FileTypeController extends Controller
{
    /**
     * @var FileTypeRepository
     */
    private $fileTypeRepository;

    /**
     * FileTypeController constructor.
     * @param FileTypeRepository $fileTypeRepository
     */
    public function __construct(FileTypeRepository $fileTypeRepository)
    {
        $this->fileTypeRepository = $fileTypeRepository;
    }

    public function datatable()
    {
        return $this->fileTypeRepository->dataTables()
                ->addColumn('actions', function (FileType $fileType){
                    $edit  = actionLink(
                        'javascript:;',
                        'btn btn-icon-only edit yellow',
                        'fa fa-pencil',
                        ['data-id' => $fileType->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ]
                    );

                    $trash = actionLink(
                        'javascript:;',
                        'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                        'fa fa-trash',
                        ['data-id' => $fileType->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
                    );
                    return "$edit $trash";
                })
                ->rawColumns(['actions'])
                ->toJson();
    }

    public function options()
    {
        return response()->json(
            $this->fileTypeRepository->options( primaryKey(), file_types() ),
            200
        );
    }

    public function stats()
    {
        return response()->json( $this->fileTypeRepository->stats(), 200 );
    }
}