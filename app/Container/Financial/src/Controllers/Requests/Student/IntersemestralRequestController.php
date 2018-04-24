<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Requests\Requests\Student\IntersemestralStudentRequest;
use App\Http\Controllers\Controller;;

class IntersemestralRequestController extends Controller
{
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;

    /**
     * IntersemestralRequestController constructor.
     * @param IntersemestralRepository $intersemestralRepository
     */
    public function __construct(IntersemestralRepository $intersemestralRepository)
    {
        $this->middleware( 'request.status:'.status_type_intersemestral(), ['only' => ['edit'] ] );
        $this->middleware( 'check.available:'.status_type_intersemestral(), ['only' => ['create', 'store', 'edit', 'update', 'destroy'] ] );
        $this->intersemestralRepository = $intersemestralRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.requests.student.intersemestral.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financial.requests.student.intersemestral.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IntersemestralStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IntersemestralStudentRequest $request)
    {
        return ( $this->intersemestralRepository->storeStudentIntersemestral( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'messages.inter_processed_fail', 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('financial.requests.student.intersemestral.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        return view('financial.requests.student.intersemestral.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id )
    {
        return ( $this->intersemestralRepository->subscribeStudent( $id ) ) ?
            jsonResponse('success', 'subscribe_done', 200) :
            jsonResponse('error', 'subscribe_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ( $this->intersemestralRepository->deleteStudentIntersemestral( $id ) ) ?
            jsonResponse('success', 'unsubscribe_done', 200) :
            jsonResponse('error', 'unsubscribe_fail', 422);
    }
}