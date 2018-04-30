<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Financial\src\Requests\Comments\CommentRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
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
     * @return \Illuminate\Http\Response
     */
    public function ownFiles()
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->fileRepository->ownFiles(), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Show an specific file
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function showFile($id )
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->fileRepository->showFile( $id ), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Return a files list with approved status
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedFiles()
    {
        if ( request()->isMethod('GET') ) {
            $approved = $this->fileRepository->allFiles()->whereHas('status', function ($query) {
                return $query->where(status_name(), approved_status());
            })->paginate(4);

            return response()->json($approved, 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Return a files list with a different approved status
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingFiles()
    {
        if ( request()->isMethod('GET') ) {
            $approved = $this->fileRepository->allFiles()->whereHas('status', function ($query) {
                return $query->where(status_name(), '!=', approved_status());
            })->orWhereDoesntHave('status')->paginate(4);

            return response()->json($approved, 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Store a new comment for a file
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(CommentRequest $request )
    {
        if ( request()->isMethod('POST') )
            return ( $this->fileRepository->comment( $request ) ) ? AjaxResponse::success() : AjaxResponse::fail();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Get a comment for a specific resource
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getComments($id )
    {
        if ( request()->isMethod( 'GET' ) )
            return response()->json( $this->fileRepository->get(['comments.user:id,name,lastname'], $id)->comments, 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get a list with status files
     *
     * @return \Illuminate\Http\Response
     */
    public function fileStatus()
    {
        if ( request()->isMethod( 'GET' ) )
            return response()->json( $this->statusRequestRepository->tree( status_type_file() )->where( status_name(), '!=', sent_status() )->get(), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}