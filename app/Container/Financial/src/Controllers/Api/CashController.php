<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CashRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;

class CashController extends Controller
{
    /**
     * @var CashRepository
     */
    private $cashRepository;

    /**
     * CashRepository constructor.
     * @param CashRepository $cashRepository
     */
    public function __construct(CashRepository $cashRepository)
    {
        $this->cashRepository = $cashRepository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        if (request()->isMethod('GET'))
            return $this->cashRepository->datatable();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}