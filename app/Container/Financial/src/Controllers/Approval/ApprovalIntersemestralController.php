<?php

namespace App\Container\Financial\src\Controllers\Approval;

use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Requests\Approval\ApprovalIntersemestralRequest;
use App\Container\Financial\src\Requests\Approval\PaidIntersemestralStatusRequest;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\IntersemestralTransformer;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class ApprovalIntersemestralController extends Controller
{
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param IntersemestralRepository $intersemestralRepository
     */
    public function __construct(IntersemestralRepository $intersemestralRepository)
    {
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
            return view('financial.approval.intersemestral.index');

        return abort( 405 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApprovalIntersemestralRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApprovalIntersemestralRequest $request, $id)
    {
        if ( request()->isMethod('PUT') || request()->isMethod('PATCH') )
            return ( $this->intersemestralRepository->updateAdminIntersemestral($request, $id ) ) ?
                jsonResponse('success', 'updated_done', 200) :
                jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    /**
     * Store a paid status resource in storage.
     *
     * @param PaidIntersemestralStatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaidIntersemestralStatusRequest $request)
    {
            if ( request()->isMethod('POST') )
                return ( $this->intersemestralRepository->paid( $request ) ) ?
                    jsonResponse('success', 'updated_done', 200) :
                    jsonResponse('error', 'updated_fail', 422);

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'PUT / PATCH']), '', 405);
    }

    public function report(Request $request)
    {
        $items = $this->intersemestralRepository->getModel()->with([
            'subject' => function ($q) {
                return $q->with([
                    'programs',
                    'teachers:id,name,lastname,phone,email'
                ]);
            },
            'status',
            'secretary:id,name,lastname,phone,email',
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
        $resources = new Collection($items, new IntersemestralTransformer);
        $data = $manager->createData($resources);
        if ( $request->has('program') && $request->program) {
            $data = $data->toArray();
            $data = collect( $data['data'] );
            $data = $data->where('program_id', $request->program);
        }
        $data = $data->toArray();
        $data = isset( $data['data'] ) ? $data['data'] : $data;
        $title = 'Intersemestrales';
        return SnappyPdf::loadView('financial.reports.request', compact('data', 'start', 'end', 'title'))
            ->download( 'Report-'.now()->toDateTimeString().'.pdf' );
    }
}