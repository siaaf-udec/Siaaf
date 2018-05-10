<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\IntersemestralStudentTransformer;
use App\Transformers\Financial\IntersemestralTransformer;
use App\Transformers\Financial\SubjectProgramTransformer;
use Yajra\DataTables\DataTables;

class IntersemestralController extends Controller
{
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;

    /**
     * ExtensionController constructor.
     * @param IntersemestralRepository $intersemestralRepository
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct(IntersemestralRepository $intersemestralRepository, StatusRequestRepository $statusRequestRepository)
    {
        $this->intersemestralRepository = $intersemestralRepository;
        $this->statusRequestRepository = $statusRequestRepository;
    }

    /**
     * Return a Datatable query format
     *
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        if ( request()->isMethod('GET') )
            return DataTables::of( $this->intersemestralRepository->getAuth() )
                            ->setTransformer( new IntersemestralStudentTransformer )
                            ->toJson();

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Return an specific auth user source format
     *
     * @param $id
     * @return array|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function auth( $id )
    {
        if ( request()->isMethod('GET') ) {
            if ( auth()->user()->can( permission_intersemestral() ) ) {
                $model = $this->intersemestralRepository->getAuth()->where(intersemestral_fk(), $id)->first();
                return isset($model) ? (new IntersemestralStudentTransformer)->transform($model) : [];
            }
            return AjaxResponse::make(__('javascript.http_status.error', ['status' => 403]), __('javascript.http_status.403'), '', 403);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Return an specific source format
     *
     * @param $id
     * @return array|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function admin( $id )
    {
        if ( request()->isMethod('GET') ) {
            if ( auth()->user()->can( permission_intersemestral_approval() ) ) {
                $model = $this->intersemestralRepository->getModel()->with([
                    'subject' => function ($query) {
                        return $query->with([
                            'programs',
                            'teachers:id,name,lastname,phone,email'
                        ]);
                    },
                    'status',
                    'secretary:id,name,lastname,phone,email',
                    'cost',
                    'subscribed' => function ($query) {
                        return $query->with([
                            'student:id,name,lastname,phone,email',
                        ]);
                    }
                ])->withCount([
                    'subscribed',
                    'subscribed as subscribed_paid_count' => function ($query) {
                        return $query->whereHasPaid();
                    },
                    'comments'
                ])->find($id);
                return isset($model) ? (new IntersemestralTransformer)->transform($model) : [];
            }
            return AjaxResponse::make(__('javascript.http_status.error', ['status' => 403]), __('javascript.http_status.403'), '', 403);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Return the subject primary keys relation to edit the source
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        if ( request()->isMethod('GET') ) {
            return response()->json((new SubjectProgramTransformer)
                ->transform($this->intersemestralRepository->subjectRelation($id)),
                200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Return the available intersemestral sources
     *
     * @return \Illuminate\Http\Response
     */
    public function available()
    {
        if ( request()->isMethod('GET') )
            return response()->json( $this->intersemestralRepository->getAvailable( 15 ),
                                200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}