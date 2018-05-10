<?php

namespace App\Container\Financial\src\Repository;

use App\Container\Financial\src\AdditionSubtraction;
use App\Container\Financial\src\Interfaces\FinancialAddSubInterface;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\SubjectProgram;
use App\Transformers\Financial\AdditionSubtractionDataTableTransformer;
use League\Fractal\Resource\Collection;

class AddSubRepository extends Methods implements FinancialAddSubInterface
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
     * ExtensionRepository constructor.
     * @param StatusRequestRepository $statusRequestRepository
     * @param CostServiceRepository $costServiceRepository
     */
    public function __construct(StatusRequestRepository $statusRequestRepository, CostServiceRepository $costServiceRepository)
    {
        parent::__construct( AdditionSubtraction::class );
        $this->statusRequestRepository = $statusRequestRepository;
        $this->costServiceRepository = $costServiceRepository;
    }

    /**
     * Store data in database
     *
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request )
    {
        $status = $this->statusRequestRepository->getId( status_type_addition_subtraction(), sent_status() );
        $cost_service = $this->costServiceRepository->getId( status_type_addition_subtraction() );

        if ( isset( $status->{ primaryKey() } ) && isset( $cost_service->{ primaryKey() } ) ) {
            $model->{ action_subject() }    =   $request->action;
            $model->{ subject_fk() }        =   $request->subject_matter;
            $model->{ student_fk() }        =   auth()->user()->id;
            $model->{ status_fk() }         =   $status->{ primaryKey() };
            $model->{ cost_service_fk() }   =   $cost_service->{ primaryKey() };
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
    public function updateAdminAddSub($request, $id )
    {
        $approved = $this->statusRequestRepository->getId( status_type_addition_subtraction(), approved_status() );
        $model = $this->getModel()->find( $id );
        if ( isset( $approved->{ primaryKey() }, $model ) ) {
            if ($request->status == $approved->{primaryKey()}) {
                if (!isset($model->{approval_date()})) {
                    $model->{approval_date()} = now();
                    $model->{approved_by()} = auth()->user()->id;
                }
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
        return $this->statusRequestRepository->getNames( status_type_addition_subtraction() );
    }

    /**
     * Store a new student with initials status and cost
     *
     * @param $request
     * @return mixed
     */
    public function storeStudentAddSub( $request )
    {
        $status = $this->statusRequestRepository->getId( status_type_addition_subtraction(), sent_status() );
        $cost_service = $this->costServiceRepository->getId( status_type_addition_subtraction() );
        if ( isset( $status->{ primaryKey() } ) && isset( $cost_service->{ primaryKey() } ) ) {
            $model = $this->getModel();
            $model->{action_subject()} = $request->action;
            $model->{subject_fk()} = $request->subject_matter;
            $model->{student_fk()} = auth()->user()->id;
            $model->{cost_service_fk()} = $cost_service->{primaryKey()};
            $model->{status_fk()} = $status->{primaryKey()};
            return $model->save();
        }

        return false;
    }

    /**
     * Update student request
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateStudentAddSub( $request, $id )
    {
        $model = auth()->user()->additionSubtraction()->find( $id );
        $model->{ action_subject() }    =   $request->action;
        $model->{ subject_fk() }        =   $request->subject_matter;
        return $model->save();
    }

    /**
     * Delete a student request
     *
     * @param $id
     * @return bool
     */
    public function deleteStudentAddSub( $id )
    {
        $model = $this->getAuth(['status'], $id);
        return ( $model && $model->status->{ status_name() } == pending_status() || $model->status->{ status_name() } == sent_status() ) ? $model->forceDelete() : false;
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
        $model = SubjectProgram::where( subject_fk() , isset( $model->{ subject_fk() } ) ? $model->{ subject_fk() } : 0 );
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

        if ( $status ) {
            $items = $items->whereHas('status', function ($query) use ($status) {
                $query->where( primaryKey(), $status );
            });
        }

        $items = $items->paginate( $quantity );


        $collection = $items->getCollection()
            ->map(function( $model ) {
                return $this->formatData( $model );
            })->toArray();

        return customPagination( $collection,  $items);
    }

    /**
     * Retrieve the auth user extension
     *
     * @param array $relations
     * @param $id
     * @return mixed
     */
    public function getAuth(array $relations = [], $id)
    {
        $model = auth()->user()->additionSubtraction();
        return ( count( $relations ) ) ? $model->with( $relations )->findOrFail( $id ) : $model->findOrFail( $id ) ;
    }

    /**
     * Transform database collection
     *
     * @param $model
     * @return array
     */
    public function formatData( $model )
    {
        return (new AdditionSubtractionDataTableTransformer)->transform( $model );
    }
}