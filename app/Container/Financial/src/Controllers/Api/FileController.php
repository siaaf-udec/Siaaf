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

    /**
     * Return a list of auth user files
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ownFiles()
    {
        return response()->json( $this->fileRepository->ownFiles(), 200 );
    }

    /**
     * Show an specific file
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showFile($id )
    {
        return response()->json( $this->fileRepository->showFile( $id ), 200 );
    }

    /**
     * Return a files list with approved status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvedFiles()
    {
        $approved = $this->fileRepository->allFiles()->whereHas( 'status', function ($query) {
            return $query->where( status_name(), approved_status() );
        })->paginate(4);

        return response()->json($approved, 200);
    }

    /**
     * Return a files list with a different approved status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingFiles()
    {
        $approved = $this->fileRepository->allFiles()->whereHas( 'status', function ($query) {
            return $query->where( status_name(), '!=', approved_status() );
        })->orWhereDoesntHave('status')->paginate(4);

        return response()->json($approved, 200);
    }

    /**
     * Store a new comment for a file
     *
     * @param CommentRequest $request
     */
    public function storeComment(CommentRequest $request )
    {
        $this->fileRepository->comment( $request );
    }

    /**
     * Get a comment for a specific resource
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComments($id )
    {
        return response()->json( $this->fileRepository->get(['comments.user:id,name,lastname'], $id)->comments, 200 );
    }

    /**
     * Get a list with status files
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fileStatus()
    {
        return response()->json( $this->statusRequestRepository->tree( status_type_file() )->where( status_name(), '!=', sent_status() )->get(), 200 );
    }
}