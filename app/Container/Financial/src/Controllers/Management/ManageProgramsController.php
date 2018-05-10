<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\ProgramRepository;
use App\Container\Financial\src\Requests\Program\StoreProgramRequest;
use App\Container\Financial\src\Requests\Program\UpdateProgramRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Routing\Controller;

class ManageProgramsController extends Controller
{
    /**
     * @var ProgramRepository
     */
    private $programRepository;

    /**
     * ManageProgramsController constructor.
     * @param ProgramRepository $programRepository
     */
    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.management.programs.index');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProgramRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->programRepository->store($request ) ) ?
                    jsonResponse() :
                    jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProgramRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->programRepository->update($request, $id ) ) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( request()->isMethod('DELETE') )
            return ( $this->programRepository->destroy( $id ) ) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}