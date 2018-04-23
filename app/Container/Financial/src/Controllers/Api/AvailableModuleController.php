<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\AvailableModulesRepository;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function modules()
    {
        return response()->json( $this->availableModulesRepository->getAll(), 200 );
    }
}