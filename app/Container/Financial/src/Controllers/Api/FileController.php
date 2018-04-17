<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Financial\src\Requests\Comments\CommentRequest;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * @var FileRepository
     */
    private $fileRepository;
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;

    /**
     * FileController constructor.
     * @param FileRepository $fileRepository
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct(FileRepository $fileRepository, StatusRequestRepository $statusRequestRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->statusRequestRepository = $statusRequestRepository;
    }

    public function ownFiles()
    {
        return response()->json( $this->fileRepository->ownFiles(), 200 );
    }

    public function showFile( $id )
    {
        return response()->json( $this->fileRepository->showFile( $id ), 200 );
    }

    public function approvedFiles()
    {
        $approved = $this->fileRepository->allFiles()->whereHas( 'status', function ($query) {
            return $query->where( status_name(), 'APROBADO' );
        })->paginate(4);

        return response()->json($approved, 200);
    }

    public function pendingFiles()
    {
        $approved = $this->fileRepository->allFiles()->whereHas( 'status', function ($query) {
            return $query->where( status_name(), '!=', 'APROBADO' );
        })->orWhereDoesntHave('status')->paginate(4);

        return response()->json($approved, 200);
    }
    
    public function storeComment( CommentRequest $request )
    {
        $this->fileRepository->comment( $request );
    }

    public function getComments( $id )
    {
        return response()->json( $this->fileRepository->get(['comments.user:id,name,lastname'], $id)->comments, 200 );
    }

    public function fileStatus()
    {
        return response()->json( $this->statusRequestRepository->tree( 'FILE' )->where( status_name(), '!=', 'ENVIADO' )->get(), 200 );
    }
}