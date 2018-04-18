<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;
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
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return DataTables::of( $this->intersemestralRepository->getAuth() )
                        ->setTransformer( new IntersemestralStudentTransformer )
                        ->toJson();
    }

    /**
     * @param $id
     * @return array
     * @throws \Throwable
     */
    public function auth( $id )
    {
        $model = $this->intersemestralRepository->getAuth()->where( intersemestral_fk(), $id )->first();
        return isset( $model ) ? ( new IntersemestralStudentTransformer )->transform( $model ) : [];
    }

    /**
     * @param $id
     * @return array
     * @throws \Throwable
     */
    public function admin( $id )
    {
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
            'subscribed as subscribed_paid_count' => function ( $query ) {
                return $query->whereHasPaid();
            },
            'comments'
        ])->find( $id );
        return isset( $model ) ? ( new IntersemestralTransformer )->transform( $model ) : [];
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id )
    {
        return response()->json( ( new SubjectProgramTransformer )
                                    ->transform( $this->intersemestralRepository->subjectRelation( $id ) ) ,
                                200 );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function available()
    {
        return response()->json( $this->intersemestralRepository->getAvailable( 15 ),
                                200 );
    }
}