<?php

namespace App\Container\Financial\src\Controllers\Files;


use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Requests\File\UpdateFileStatusRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * ManagementController constructor.
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
        if ( request()->isMethod('GET') )
            return view('financial.files.request.index');

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFileStatusRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileStatusRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return $this->fileRepository->managementUpdate( $request, $id ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }
}