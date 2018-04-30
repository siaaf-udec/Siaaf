<?php

namespace App\Container\Financial\src\Repository;

use App\Container\Financial\src\Interfaces\FinancialIntersemestralInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Intersemestral;
use App\Container\Financial\src\SubjectProgram;
use App\Transformers\Financial\IntersemestralFeedTransformer;
use App\Transformers\Financial\IntersemestralTransformer;
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
     * Store a new data in database
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process( $model, $request )
    {
        $status = $this->statusRequestRepository->getId( status_type_intersemestral(), sent_status() );
        $cost_service = $this->costServiceRepository->getId( status_type_intersemestral() );

        if ( isset( $status->{ primaryKey() } ) && isset( $cost_service->{ primaryKey() } ) ) {
            $model->{student_fk()} = auth()->user()->id;
            $model->{status_fk()} = $status->{primaryKey()};
            $model->{cost_service_fk()} = $cost_service->{primaryKey()};
            return $model->save();
        }

        return false;
    }

    /**
     * Update status of the specific resource
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateAdminIntersemestral($request, $id )
    {
        $approved = $this->statusRequestRepository->getId( status_type_intersemestral(), approved_status() );
        $model = $this->getModel()->find( $id );

        if ( isset( $approved->{ primaryKey() }, $model ) ) {
            if ($request->status == $approved->{primaryKey()}) {
                if (!isset($model->{approval_date()})) {
                    $model->{approval_date()} = now();
                    $model->{approved_by()} = auth()->user()->id;
                }
                $model->{realization_date()} = $request->date;
            }
            $model->{status_fk()} = $request->status;
            return $model->save();
        }
        return false;
    }

    /**
     * Get a count data
     *
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
     * Get available status
     *
     * @return mixed
     */
    public function availableStatus()
    {
        return $this->statusRequestRepository->getNames( status_type_intersemestral() );
    }

    /**
     * Store a new student with initials status and cost
     *
     * @param $request
     * @return mixed
     */
    public function storeStudentIntersemestral( $request )
    {

        $intersemestral = $this->findIfExist( $request->subject_matter );

        if ( $intersemestral && isset( $intersemestral->{ primaryKey() } ) ) {
            return $this->intersemestralStudentRepository->subscribe( $intersemestral->{ primaryKey() } );
        }

        $status = $this->statusRequestRepository->getId( status_type_intersemestral(), waiting_quota_status() );
        $cost_service = $this->costServiceRepository->getId( status_type_intersemestral() );
        if ( isset( $status->{ primaryKey() } ) && isset( $cost_service->{ primaryKey() } ) ) {
            $model = $this->getModel();
            $model->{subject_fk()} = $request->subject_matter;
            $model->{cost_service_fk()} = $cost_service->{primaryKey()};
            $model->{status_fk()} = $status->{primaryKey()};
            if ($model->save()) {
                return $this->intersemestralStudentRepository->subscribe($model->{primaryKey()});
            }

            return false;
        }

        return false;
    }

    /**
     * Subscribe a student in an intersemestral
     *
     * @param $id
     * @return mixed
     */
    public function subscribeStudent( $id )
    {
        return $this->intersemestralStudentRepository->subscribe( $id );
    }

    /**
     * Update paid status
     *
     * @param $request
     * @return mixed
     */
    public function paid($request )
    {
        return $this->intersemestralStudentRepository->updatePaidStatus( $request );
    }

    /**
     * Delete a student from intersemestral
     *
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
     * Get subject relations stored
     *
     * @param $id
     * @param bool $whitRelations
     * @return mixed
     */
    public function subjectRelation($id, $whitRelations = false )
    {
        $model = $this->getAuth( [], $id );
        $model = SubjectProgram::where( subject_fk() , isset($model->{ subject_fk() }) ? $model->{ subject_fk() } : 0 );
        $model = $whitRelations ? $model->with(['programs', 'subjects', 'teachers:id,name,lastname,phone,email']) : $model;
        return $model->first();
    }

    /**
     * Get data paginate
     *
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
     * Get available data paginate
     *
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
     * Retrieve the auth user intersemestral
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
     * Find if exist intersemestral request
     *
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
     * Return data transformed
     *
     * @param $model
     * @return array
     * @throws \Throwable
     */
    public function formatData( $model )
    {
        return ( new IntersemestralTransformer )->transform( $model );
    }
}