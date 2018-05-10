<?php

namespace App\Container\Financial\src\Controllers\Cash;


use App\Container\Financial\src\Repository\CheckRepository;
use App\Container\Financial\src\Requests\Check\CheckRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class CheckController extends Controller
{
    /**
     * @var CheckRepository
     */
    private $checkRepository;

    /**
     * CheckController constructor.
     * @param CheckRepository $checkRepository
     */
    public function __construct(CheckRepository $checkRepository)
    {
        $this->checkRepository = $checkRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.check.index');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->checkRepository->store( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CheckRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->checkRepository->update($request, $id ) ) ?
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
        if ( request()->isMethod('DELETE') ) {
            if ($this->checkRepository->checkStatus($id)) {
                return jsonResponse('error', 'deleted_fail_status', 422);
            }
            return ($this->checkRepository->destroy($id)) ?
                jsonResponse('success', 'deleted_done', 200) :
                jsonResponse('error', 'deleted_fail', 422);
        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}