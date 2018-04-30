<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\ProgramRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\ProgramTransformer;

class ProgramsController extends Controller
{
    /**
     * @var ProgramRepository
     */
    private $programRepository;

    /**
     * ProgramsController constructor.
     * @param ProgramRepository $programRepository
     */
    public function __construct(ProgramRepository $programRepository)
    {
        $this->programRepository = $programRepository;
    }

    /**
     * Return a Datatable query format
     *
     * @return mixed
     */
    public function datatable()
    {
        if ( request()->isMethod( 'GET' ) ) {
            return $this->programRepository->dataTables()
                            ->setTransformer( new ProgramTransformer )
                            ->toJson();
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}