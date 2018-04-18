<?php

namespace App\Container\Financial\src\Repository;

use App\Container\Financial\src\Interfaces\FinancialIntersemestralInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Intersemestral;
use App\Container\Financial\src\SubjectProgram;
use App\Transformers\Financial\IntersemestralFeedTransformer;
use App\Transformers\Financial\IntersemestralTransformer;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class IntersemestralRepository extends Methods implements FinancialIntersemestralInterface
{
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;
    /**
     * @var CostServiceRepository
     */
    private $costServiceRepository;
    /**
     * @var IntersemestralStudentRepository
     */
    private $intersemestralStudentRepository;

    /**
     * ExtensionRepository constructor.
     * @param StatusRequestRepository $statusRequestRepository
     * @param IntersemestralStudentRepository $intersemestralStudentRepository
     * @param CostServiceRepository $costServiceRepository
     */
    public function __construct(StatusRequestRepository $statusRequestRepository,
                                IntersemestralStudentRepository $intersemestralStudentRepository,
                                CostServiceRepository $costServiceRepository)
    {
        parent::__construct( Intersemestral::class );
        $this->statusRequestRepository = $statusRequestRepository;
        $this->costServiceRepository = $costServiceRepository;
        $this->intersemestralStudentRepository = $intersemestralStudentRepository;
    }

    /**
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process( $model, $request )
    {
        $status = $this->statusRequestRepository->getId( 'INTERSEMESTER', 'ENVIADO' );
        $cost_service = $this->costServiceRepository->getId( 'INTERSEMESTER' );
        //$model->{ approval_date() }     =   $request->approval_date;
        $model->{ student_fk() }        =   auth()->user()->id;
        $model->{ status_fk() }         =   $status->{ primaryKey() };
        $model->{ cost_service_fk() }   =   $cost_service->{ primaryKey() };
        //$model->{ approved_by() }       =   auth()->user()->id;
        return $model->save();
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateAdminIntersemestral($request, $id )
    {
        $approved = $this->statusRequestRepository->getId( 'INTERSEMESTER', 'APROBADO' );
        $model = $this->getModel()->find( $id );
        if ( $request->status == $approved->{ primaryKey() } ) {
            if ( !isset( $model->{ approval_date() } ) ) {
                $model->{ approval_date() } = now();
                $model->{ approved_by() }   = auth()->user()->id;
            }
            $model->{ realization_date() }  =   $request->date;
        }
        $model->{ status_fk() }         =   $request->status;
        return $model->save();
    }

    /**
     * @param array $status
     * @return mixed
     */
    public function count( $status = [] )
    {
        $model = $this->getModel();
        $model = ( $status ) ? $model->whereIn( status_fk(),  $status ) : $model;
        return $model->count();
    }

    /**
     * @return mixed
     */
    public function availableStatus()
    {
        return $this->statusRequestRepository->getNames( 'INTERSEMESTER' );
    }

    /**
     * @param $request
     * @return mixed
     */
    public function storeStudentIntersemestral( $request )
    {

        $intersemestral = $this->findIfExist( $request->subject_matter );

        if ( $intersemestral && isset( $intersemestral->{ primaryKey() } ) ) {
            return $this->intersemestralStudentRepository->subscribe( $intersemestral->{ primaryKey() } );
        }

        $status = $this->statusRequestRepository->getId( 'INTERSEMESTER', 'EN ESPERA DE COMPLETAR CUPO MÍNIMO' );
        $cost_service = $this->costServiceRepository->getId( 'INTERSEMESTER' );
        $model = $this->getModel();
        $model->{ subject_fk() }        =  $request->subject_matter;
        $model->{ cost_service_fk() }   =  $cost_service->{ primaryKey() };
        $model->{ status_fk() }         =  $status->{ primaryKey() };
        if ( $model->save() ) {
            return $this->intersemestralStudentRepository->subscribe( $model->{ primaryKey() } );
        }

        return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function subscribeStudent( $id )
    {
        return $this->intersemestralStudentRepository->subscribe( $id );
    }

    /**
     * @param $request
     * @return mixed
     */
    public function paid($request )
    {
        return $this->intersemestralStudentRepository->updatePaidStatus( $request );
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteStudentIntersemestral( $id )
    {
        $model = auth()->user()->intersemestrals()
                        ->currentSubscribers()
                        ->where( intersemestral_fk(), $id )->first();
        if ( $model ) {
            return ( $model->{ paid() } ) ? false : $model->delete();
        }

        return false;
    }

    /**
     * @param $id
     * @param bool $whitRelations
     * @return mixed
     */
    public function subjectRelation($id, $whitRelations = false )
    {
        $model = $this->getAuth( [], $id );
        $model = SubjectProgram::where( subject_fk() , $model->{ subject_fk() } );
        $model = $whitRelations ? $model->with(['programs', 'subjects', 'teachers:id,name,lastname,phone,email']) : $model;
        return $model->first();
    }

    /**
     * @param int $quantity
     * @param null $status
     * @return Collection
     */
    public function getAllPaginate($quantity = 5, $status = null )
    {
        $items = $this->getModel()->with([
            'subject',
            'status',
        ])->withCount([
            'subscribed',
            'subscribed as subscribed_paid_count' => function ( $query ) {
                return $query->whereHasPaid();
            },
            'comments'
        ])->latest();

        if ( $status ) {
            $items = $items->whereHas('status', function ($query) use ($status) {
                $query->where( primaryKey(), $status );
            });
        }

        $items = $items->paginate( $quantity );

        $resource = $items->getCollection()
            ->map(function($model) {
                return ( new IntersemestralFeedTransformer )->transform( $model );
            })->toArray();

        return customPagination( $resource,  $items);
    }

    /**
     * @param int $pagination
     * @return array
     */
    public function getAvailable( $pagination = 5 )
    {
        $items = $this->getModel()->with([
                'subject',
                'status',
            ])->withCount([
                'subscribed',
                'subscribed as subscribed_paid_count' => function ( $query ) {
                    return $query->whereHasPaid();
                },
                'comments'
            ])->availableIntersemestrals()->paginate( $pagination );


        $resource = $items->getCollection()
            ->map(function($model) {
                return ( new IntersemestralFeedTransformer )->transform( $model );
            })->toArray();
        return customPagination( $resource,  $items);
    }

    /**
     * Retrieve  the auth user intersemestral
     *
     * @return mixed
     */
    public function getAuth()
    {
        return auth()->user()->intersemestrals()
            ->with([
                'student:id,name,lastname,phone,email',
                'subscribed' => function ( $query ) {
                    return $query->with([
                        'subject' => function ($query) {
                            return $query->with([
                                'programs',
                                'teachers:id,name,lastname,phone,email'
                            ]);
                        },
                        'status',
                        'secretary:id,name,lastname,phone,email',
                        'cost'
                    ])->withCount([
                        'subscribed',
                        'subscribed as subscribed_paid_count' => function ( $query ) {
                            return $query->whereHasPaid();
                        },
                        'comments'
                    ]);
                },
            ])
            ->orderBy(created_at(), 'DESC');
    }

    /**
     * @param $subject
     * @return bool
     */
    public function findIfExist( $subject )
    {
        $model = $this->getModel()->select( primaryKey() )
            ->availableIntersemestrals()->where( subject_fk(), $subject )->first();
        return ( $model ) ? $model : false;
    }

    /**
     * @param $model
     * @return array
     * @throws \Throwable
     */
    public function formatData( $model )
    {
        return ( new IntersemestralTransformer )->transform( $model );
    }
}