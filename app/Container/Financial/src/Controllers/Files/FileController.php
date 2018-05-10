<?php

namespace App\Container\Financial\src\Controllers\Files;


use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Requests\File\StoreFileRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * FileController constructor.
     * @param FileRepository $fileRepository
     */
    public function __construct(FileRepository $fileRepository)
    {
        $this->middleware( 'check.available:'.status_type_file(), ['only' => ['store', 'update'] ] );
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.files.upload.index');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        if ( request()->isMethod('POST') ) {
            if (!$this->fileRepository->checkLatestRequest()) {
                return $this->fileRepository->studentUpload($request) ?
                    jsonResponse() :
                    jsonResponse('error', 'processed_fail', 422);
            }
            return jsonResponse('warning', 'messages.request_in_process', 422);
        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( $id )
    {
        if ( request()->isMethod('GET') )
            return view('financial.files.upload.show', compact('id') );

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreFileRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFileRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return $this->fileRepository->studentUpdate( $request, $id ) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }
}