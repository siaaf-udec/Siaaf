<?php
/**
 * Created by PhpStorm.
 * User: danielprado
 * Date: 20/07/17
 * Time: 10:12 PM
 */

namespace App\Container\Financial\src\Controllers\Files;


use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Requests\File\UpdateFileStatusRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('financial.files.request.index');
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
        return $this->fileRepository->managementUpdate( $request, $id ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }
}