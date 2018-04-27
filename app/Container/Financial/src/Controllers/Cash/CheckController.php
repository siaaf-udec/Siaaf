<?php

namespace App\Container\Financial\src\Controllers\Cash;


use App\Container\Financial\src\Repository\CheckRepository;
use App\Container\Financial\src\Requests\Check\CheckRequest;
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
        return view('financial.check.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckRequest $request)
    {
        return ( $this->checkRepository->store( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'processed_fail', 422);
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
        return ( $this->checkRepository->update($request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $this->checkRepository->checkStatus( $id ) ) {
            return jsonResponse('error', 'deleted_fail_status', 422);
        }
        return ( $this->checkRepository->destroy( $id ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);
    }
}