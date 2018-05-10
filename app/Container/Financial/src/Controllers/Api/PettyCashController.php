<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\CashRepository;
use App\Http\Controllers\Controller;

class PettyCashController extends Controller
{
    /**
     * @var CashRepository
     */
    private $cashRepository;

    /**
     * PettyCashController constructor.
     * @param CashRepository $cashRepository
     */
    public function __construct(CashRepository $cashRepository)
    {
        $this->cashRepository = $cashRepository;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function counter()
    {
        return response()->json( $this->cashRepository->counter(), 200 );
    }
}