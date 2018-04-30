<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Requests\Requests\Student\IntersemestralStudentRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
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
        //$this->middleware( 'request.status:'.status_type_intersemestral(), ['only' => ['edit'] ] );
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
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.intersemestral.index');

        return abort( 405 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.intersemestral.create');

        return abort( 405 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IntersemestralStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IntersemestralStudentRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->intersemestralRepository->storeStudentIntersemestral( $request ) ) ?
                jsonResponse() :
                jsonResponse('error', 'messages.inter_processed_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'POST']), '', 405);
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
            return view('financial.requests.student.intersemestral.show', compact('id'));

        return abort( 405 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.intersemestral.edit', compact('id'));

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id )
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->intersemestralRepository->subscribeStudent( $id ) ) ?
                jsonResponse('success', 'subscribe_done', 200) :
                jsonResponse('error', 'subscribe_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( request()->isMethod('DELETE') )
            return ( $this->intersemestralRepository->deleteStudentIntersemestral( $id ) ) ?
                jsonResponse('success', 'unsubscribe_done', 200) :
                jsonResponse('error', 'unsubscribe_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}