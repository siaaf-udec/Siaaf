<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CheckRepository;
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
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        if (request()->isMethod('GET'))
            return $this->checkRepository->datatable();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}