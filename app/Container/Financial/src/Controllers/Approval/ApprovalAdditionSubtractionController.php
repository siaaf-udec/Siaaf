<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalAdditionSubtractionRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\AdditionSubtractionDataTableTransformer;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class ApprovalAdditionSubtractionController extends Controller
{
    /**
     * @var AddSubRepository
     */
    private $addSubRepository;

    /**
     * ApprovalExtensionController constructor.
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
        if ( request()->isMethod('GET') )
            return view('financial.approval.addsub.index');

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApprovalAdditionSubtractionRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApprovalAdditionSubtractionRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') ) {
            if ( $this->addSubRepository->canUpdateStatus($request, $id) ) {
                return ($this->addSubRepository->updateAdminAddSub($request, $id)) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);
            }
            return AjaxResponse::make(  'Advertencia',
                "No se puede cambiar el estado de ".approved_status().", ".canceled()." o ".paid_status()." a estados anteriores.", '', 422);
        }

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    public function report(Request $request)
    {
        $items = $this->addSubRepository->getModel()->with([
            'subject' => function ($q) {
                return $q->with([
                    'programs',
                    'teachers:id,name,lastname,phone,email'
                ]);
            },
            'status',
            'secretary:id,name,lastname,phone,email',
            'student:id,name,lastname,phone,email',
        ])->withCount('comments')->latest();
        $start  = $request->has('start_date') ? $request->start_date : now()->toDayDateTimeString();
        $end    = $request->has('end_date')   ? $request->end_date : now()->toDayDateTimeString();
        if ( $request->has('subject') && $request->subject) {
            $items = $items->whereHas('subject', function ($query) use ($request) {
                return $query->where( subject_fk(), $request->subject );
            });
        }
        if ( $request->has('status') && $request->status) {
            $items = $items->where( status_fk(), $request->status);
        }
        if ( $request->has('start_date') && $request->has('end_date') && $request->end_date && $request->start_date) {
            $items = $items->whereBetween( created_at(), [$request->start_date, $request->end_date] );
        }
        $items = $items->get();
        $manager = new Manager;
        $resources = new Collection($items, new AdditionSubtractionDataTableTransformer);
        $data = $manager->createData($resources);
        if ( $request->has('program') && $request->program) {
            $data = $data->toArray();
            $data = collect( $data['data'] );
            $data = $data->where('program_id', $request->program);
        }
        $data = $data->toArray();
        $data = isset( $data['data'] ) ? $data['data'] : $data;
        $title = 'Adición o Cancelación de Materias';
        return SnappyPdf::loadView('financial.reports.request', compact('data', 'start', 'end', 'title'))
            ->download( 'Report-'.now()->toDateTimeString().'.pdf' );
    }
}