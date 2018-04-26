<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CheckRepository;
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
        return $this->checkRepository->datatable();
    }
}