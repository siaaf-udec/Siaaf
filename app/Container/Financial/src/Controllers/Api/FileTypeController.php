<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\FileType;
use App\Container\Financial\src\Repository\FileTypeRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\FileTypeTransformer;

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

    /**
     * Get file type in datatable format
     *
     * @return mixed
     */
    public function datatable()
    {
        if ( request()->isMethod('GET') )
            return $this->fileTypeRepository->dataTables()
                    ->setTransformer( new FileTypeTransformer )
                    ->toJson();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get a file type for an select elements
     *
     * @return \Illuminate\Http\Response
     */
    public function options()
    {
        if ( request()->isMethod('GET') )
            return response()->json(
                $this->fileTypeRepository->options( primaryKey(), file_types() ),
                200
            );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get data to generate statistics
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->fileTypeRepository->stats(), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}