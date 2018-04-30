<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\SubjectRepository;
use App\Container\Financial\src\Subject;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\SubjectTransformer;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    /**
     * @var SubjectRepository
     */
    private $subjectRepository;

    /**
     * SubjectController constructor.
     * @param SubjectRepository $subjectRepository
     */
    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->subjectRepository->subjectsAsOptionsUnassigned(), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->subjectRepository->subjectsAsOptionsUpdate( $id ), 200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Display a listing of the source in datatable format
     *
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        if (request()->isMethod('GET'))
            return $this->subjectRepository->dataTables()
                        ->setTransformer( new SubjectTransformer )
                        ->toJson();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}