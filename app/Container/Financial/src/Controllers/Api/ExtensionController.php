<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Extension;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ExtensionController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;

    /**
     * ExtensionController constructor.
     * @param ExtensionRepository $extensionRepository
     */
    public function __construct(ExtensionRepository $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }

    public function query()
    {
        return auth()->user()->extensions()
            ->with([
                'subject' => function ($query) {
                    return $query->with('teachers:id,name,lastname');
                },
                'status',
                'cost'
            ])->orderBy(created_at(), 'DESC');
    }

    public function datatable()
    {
        return DataTables::of( $this->query() )
                        ->editColumn('cost.cost', function (Extension $extension){
                            return ( isset( $extension->cost->cost_to_money ) ) ?
                                $extension->cost->cost_to_money:
                                '$ 0';
                        })->editColumn('created_at', function (Extension $extension){
                            return $extension->{created_at()}->toFormattedDateString();
                        })
                        ->editColumn('total_cost', function (Extension $extension){
                            return ( isset( $extension->total_cost_to_money ) ) ?
                                    $extension->total_cost_to_money:
                                    '$ 0';
                        })
                        ->editColumn('status.status_name', function (Extension $extension) {
                            return $extension->status->status_label;
                        })
                        ->addColumn('actions', function (Extension $extension) {

                            $edit  = actionLink(
                                route('financial.requests.student.extension.edit', [ 'id' => $extension->{ primaryKey() }]),
                                'btn btn-icon-only yellow',
                                'fa fa-pencil',
                                [ 'data-original-title' => trans('javascript.tooltip.edit') ]
                            );

                            $trash = actionLink(
                                'javascript:;',
                                'btn btn-icon-only red trash mt-ladda-btn ladda-button',
                                'fa fa-trash',
                                ['data-id' => $extension->{ primaryKey() }, 'data-original-title' => trans('javascript.tooltip.delete') ]
                            );

                            $view = actionLink(
                                route('financial.requests.student.extension.show', [ 'id' => $extension->{ primaryKey() }]),
                                'btn btn-icon-only green',
                                'fa fa-eye',
                                [ 'data-original-title' => trans('javascript.tooltip.view') ]
                            );


                            $comments = actionLink(
                                route('financial.requests.student.extension.show', [ 'id' => $extension->{ primaryKey() }]),
                                'btn btn-icon-only blue',
                                'fa fa-comments',
                                [ 'data-original-title' => trans('javascript.tooltip.comments') ],
                                $extension->comments->count()
                            );

                            if ( isset( $extension->status->{ status_name() } ) ) {
                                if ( $extension->status->{ status_name() } == 'PENDIENTE' || $extension->status->{ status_name() } == 'ENVIADO' ) {
                                    return $view.' '.$edit.' '.$trash.' '.$comments;
                                } elseif ( $extension->status->{ status_name() } == 'RECHAZADO' ) {
                                    return $view.' '.$edit.' '.$comments;
                                } else {
                                    return $view.' '.$comments;
                                }
                            }
                        })
                        ->rawColumns(['status.status_name', 'actions'])
                        ->toJson();
    }

    public function show( $id )
    {
        $relation = [
            'subject' => function ($q) {
                return $q->with([
                    'programs',
                    'teachers:id,name,lastname,phone,email'
                ]);
            },
            'status',
            'secretary:id,name,lastname',
            'student:id,name,lastname,phone,email',
        ];
        if ( auth()->user()->hasRole( student_role() ) ) {
            $extension = $this->extensionRepository->getAuth( $relation, $id );
        } else if ( auth()->user()->hasRole( access_roles() ) ) {
            $extension = $this->extensionRepository->get( $relation, $id );
        }

        $array = [];
        $array[] = $this->extensionRepository->fillArray( $extension );

        return DataTables::of( $array )->toJson();
    }
}