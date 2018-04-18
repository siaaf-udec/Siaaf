<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\FileType;
use App\Container\Financial\src\Repository\FileTypeRepository;
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
        return $this->fileTypeRepository->dataTables()
                ->setTransformer( new FileTypeTransformer )
                ->toJson();
    }

    /**
     * Get a file type for an select elements
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function options()
    {
        return response()->json(
            $this->fileTypeRepository->options( primaryKey(), file_types() ),
            200
        );
    }

    /**
     * Get data to generate statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats()
    {
        return response()->json( $this->fileTypeRepository->stats(), 200 );
    }
}