<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CashRepository;
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
        return $this->cashRepository->datatable();
    }
}