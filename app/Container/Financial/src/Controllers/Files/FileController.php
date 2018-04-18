<?php

namespace App\Container\Financial\src\Controllers\Files;


use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Requests\File\StoreFileRequest;
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
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.files.upload.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        if ( !$this->fileRepository->checkLatestRequest() ) {
            return $this->fileRepository->studentUpload( $request ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);
        }
        return jsonResponse('warning', 'messages.request_in_process', 422);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( $id )
    {
        return view('financial.files.upload.show', compact('id') );
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
        return $this->fileRepository->studentUpdate( $request, $id ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);
    }
}