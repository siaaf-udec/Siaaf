<?php

namespace App\Container\Financial\src\Controllers\Cash;


use App\Container\Financial\src\Repository\CashRepository;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\CashTransformer;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class PettyCashReportController extends Controller
{
    /**
     * @var CashRepository
     */
    private $cashRepository;

    /**
     * PettyCashReportController constructor.
     * @param CashRepository $cashRepository
     */
    public function __construct(CashRepository $cashRepository)
    {
        $this->cashRepository = $cashRepository;
    }

    public function report(Request $request)
    {
        $report = $this->cashRepository->getModel();
        if ( $request->has('status') && $request->status ) {
            $report = $report->where( status(), $request->status );
        }

        if ( $request->has(['start_date', 'end_date']) ) {
            $report = $report->whereBetween( created_at(), [$request->start_date, $request->end_date] );
        }
        $start  = $request->has('start_date') ? $request->start_date : now()->toDayDateTimeString();
        $end    = $request->has('end_date')   ? $request->end_date : now()->toDayDateTimeString();
        $report = $report->get();
        $manager = new Manager;
        $resource = new Collection( $report, new CashTransformer );
        $data = $manager->createData( $resource )->toArray();
        return SnappyPdf::loadView('financial.reports.index', compact('data', 'start', 'end'))
                          ->download( 'Report-'.now()->toDateTimeString().'.pdf' );
    }
}