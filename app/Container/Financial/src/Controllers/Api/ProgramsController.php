<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Program;
use App\Container\Financial\src\Repository\ProgramRepository;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

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

    public function model()
    {
        return $this->programRepository->getModel();
    }

    public function datatable()
    {
        return $this->programRepository->dataTables()
            ->addColumn('actions', function (Program $program){
                $edit  = actionLink(
                    'javascript:;',
                    'btn btn-icon-only edit yellow',
                    'fa fa-pencil',
                    ['data-id' => $program->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.edit') ]
                );

                $trash = actionLink(
                    'javascript:;',
                    'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                    'fa fa-trash',
                    ['data-id' => $program->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
                );
                return "$edit $trash";
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}