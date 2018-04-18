<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Requests\Requests\Student\AddSubStudentRequest;
use App\Http\Controllers\Controller;

class AddSubRequestController extends Controller
{
    /**
     * @var AddSubRepository
     */
    private $addSubRepository;


    /**
     * AddSubRequestController constructor.
     * @param AddSubRepository $addSubRepository
     */
    public function __construct(AddSubRepository $addSubRepository)
    {
        $this->addSubRepository = $addSubRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.requests.student.addsub.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('financial.requests.student.addsub.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddSubStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubStudentRequest $request)
    {
        return ( $this->addSubRepository->storeStudentAddSub( $request ) ) ?
            jsonResponse() :
            jsonResponse('error', 'processed_fail', 422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('financial.requests.student.addsub.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        return view('financial.requests.student.addsub.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddSubStudentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddSubStudentRequest $request, $id )
    {
        return ( $this->addSubRepository->updateStudentAddSub( $request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ( $this->addSubRepository->deleteStudentAddSub( $id ) ) ?
            jsonResponse('success', 'deleted_done', 200) :
            jsonResponse('error', 'deleted_fail', 422);

    }
}