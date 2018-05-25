<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Requests\Requests\Student\ExtensionStudentRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtensionRequestController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;

    /**
     * ExtensionRequestController constructor.
     * @param ExtensionRepository $extensionRepository
     */
    public function __construct(ExtensionRepository $extensionRepository)
    {
        $this->middleware( 'request.status:'.status_type_extension(), ['only' => ['edit'] ] );
        $this->middleware( 'check.available:'.status_type_extension(), ['only' => ['store', 'update', 'destroy'] ] );
        $this->middleware( 'check.cost:'.status_type_extension(), ['only' => ['store'] ] );
        $this->middleware( 'check.latest.request:'.status_type_extension(), ['only' => ['store'] ] );
        $this->extensionRepository = $extensionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.extension.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( request()->isMethod('GET') )
            return view('financial.requests.student.extension.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ExtensionStudentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExtensionStudentRequest $request)
    {
        if ( request()->isMethod('POST') )
            return ( $this->extensionRepository->storeStudentExtension( $request ) ) ?
                    jsonResponse() :
                    jsonResponse('error', 'processed_fail', 422);

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
            return view('financial.requests.student.extension.show', compact('id'));

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
            return view('financial.requests.student.extension.edit', compact('id'));

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExtensionStudentRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExtensionStudentRequest $request, $id )
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->extensionRepository->updateStudentExtension( $request, $id ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        if ( request()->isMethod('DELETE') ) {
            if ($this->extensionRepository->deleteStudentExtension($id)) {
                if ($request->ajax()) {
                    return response()->json(null, 200);
                }
                return redirect()->route('financial.requests.student.extension.index')->with('success', 200);
            }

            $message = ['message' => trans('javascript.deleted_fail')];

            if ($request->ajax()) {
                return response()->json($message, 422);
            }
            return redirect()->back()->withErrors($message);
        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'DELETE']), '', 405);
    }
}