<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Financial\src\Repository\SubjectRepository;
use App\Container\Financial\src\Subject;
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
        return response()->json( $this->subjectRepository->subjectsAsOptionsUnassigned(), 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json( $this->subjectRepository->subjectsAsOptionsUpdate( $id ), 200 );
    }

    /**
     * Display a listing of the source in datatable format
     *
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return $this->subjectRepository->dataTables()
                        ->setTransformer( new SubjectTransformer )
                        ->toJson();
    }
}