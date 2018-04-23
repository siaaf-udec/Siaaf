<?php

namespace App\Container\Financial\src\Controllers\Requests\Student;


use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Requests\Requests\Student\ExtensionStudentRequest;
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
        $this->middleware( 'check.available:'.status_type_extension(), ['only' => ['create', 'store', 'edit', 'update', 'destroy'] ] );
        $this->extensionRepository = $extensionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial.requests.student.extension.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        return ( $this->extensionRepository->storeStudentExtension( $request ) ) ?
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
        return view('financial.requests.student.extension.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        return view('financial.requests.student.extension.edit', compact('id'));
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
        return ( $this->extensionRepository->updateStudentExtension( $request, $id ) ) ?
            jsonResponse('success', 'updated_done', 200) :
            jsonResponse('error', 'updated_fail', 422);
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
        if ( $this->extensionRepository->deleteStudentExtension( $id ) ) {
            if ( $request->ajax() ) {
                return response()->json(null, 200);
            }
            return redirect()->route('financial.requests.student.extension.index')->with('success', 200);
        }

        $message = ['message' => trans('javascript.deleted_fail') ];

        if ( $request->ajax() ) {
            return response()->json($message, 422);
        }
        return redirect()->back()->withErrors($message);

    }
}