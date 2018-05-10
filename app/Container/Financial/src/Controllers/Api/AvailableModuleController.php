<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\AvailableModulesRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class AvailableModuleController extends Controller
{
    /**
     * @var AvailableModulesRepository
     */
    private $availableModulesRepository;

    /**
     * AvailableModuleController constructor.
     * @param AvailableModulesRepository $availableModulesRepository
     */
    public function __construct(AvailableModulesRepository $availableModulesRepository)
    {
        $this->availableModulesRepository = $availableModulesRepository;
    }

    /**
     * Return a list of option for select modules
     *
     * @return \Illuminate\Http\Response
     */
    public function modules()
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->availableModulesRepository->getAll(), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}