<?php

namespace App\Container\Financial\src\Controllers\Management;


use App\Container\Financial\src\Repository\AvailableModulesRepository;
use App\Container\Financial\src\Requests\AvailableModule\AvailableModuleRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class ManageAvailableModulesController extends Controller
{
    /**
     * @var AvailableModulesRepository
     */
    private $availableModulesRepository;

    /**
     * ManageAvailableModulesController constructor.
     * @param AvailableModulesRepository $availableModulesRepository
     */
    public function __construct(AvailableModulesRepository $availableModulesRepository)
    {
        $this->availableModulesRepository = $availableModulesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view( 'financial.management.available-modules.index' );

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AvailableModuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AvailableModuleRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->availableModulesRepository->updateOrCreate( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
    }
}