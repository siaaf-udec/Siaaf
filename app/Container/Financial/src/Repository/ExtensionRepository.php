<?php

namespace App\Container\Financial\src\Repository;

use App\Container\Financial\src\Extension;
use App\Container\Financial\src\Interfaces\Methods;
use App\Container\Financial\src\Interfaces\FinancialExtensionInterface;
use App\Container\Financial\src\SubjectProgram;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

class ExtensionRepository extends Methods implements FinancialExtensionInterface
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
        parent::__construct( Extension::class );
        $this->statusRequestRepository = $statusRequestRepository;
        $this->costServiceRepository = $costServiceRepository;
    }

    /**
     * @param $model
     * @param $request
     * @return mixed
     */
    public function process($model, $request )
    {
        $model->{ approval_date() }         =  $request->approval_date;
        $model->{ realization_date() }      =  $request->realization_date;
        $model->{ subject_fk() }            =  $request->subject_matter;
        $model->{ student_fk() }            =  auth()->user()->id;
        $model->{ status_fk() }             =  2;
        $model->{ cost_service_fk() }       =  1;
        return $model->save();
    }

    public function updateAdminExtension( $request, $id )
    {
        $approved = $this->statusRequestRepository->getId( 'EXTENSION', 'APROBADO' );
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
        return $this->getModel()->whereIn( status_fk(),  $status )->count();
    }

    public function availableStatus()
    {
        return $this->statusRequestRepository->getNames( 'EXTENSION' );
    }

    /**
     * @param $request
     * @return mixed
     */
    public function storeStudentExtension( $request )
    {
        $status = $this->statusRequestRepository->getId( 'EXTENSION', 'ENVIADO' );
        $cost_service = $this->costServiceRepository->getId( 'EXTENSION' );
        $model = $this->getModel();
        $model->{ subject_fk() }    =  $request->subject_matter;
        $model->{ student_fk() }    =  auth()->user()->id;
        $model->{ cost_service_fk() }  =  $cost_service->{ primaryKey() };
        $model->{ status_fk() }     =  $status->{ primaryKey() };
        return $model->save();
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateStudentExtension( $request, $id )
    {
        $model = auth()->user()->extensions()->find( $id );
        $model->{ subject_fk() }   =  $request->subject_matter;
        return $model->save();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteStudentExtension( $id )
    {
        $extension = $this->getAuth(['status'], $id);
        return ( $extension && $extension->status->{ status_name() } == 'PENDIENTE' || $extension->status->{ status_name() } == 'ENVIADO' ) ? $extension->forceDelete() : false;
    }

    /**
     * @param $id
     * @param bool $whitRelations
     * @return mixed
     */
    public function subjectRelation($id, $whitRelations = false )
    {
        $extension = $this->getAuth( [], $id );
        $extension = SubjectProgram::where( subject_fk() , $extension->{ subject_fk() } );
        $extension = $whitRelations ? $extension->with(['programs', 'subjects', 'teachers:id,name,lastname,phone,email']) : $extension;
        return $extension->first();
    }

    public function getAllPaginate( $quantity = 5, $status = null )
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

        $data = $items->getCollection()
            ->map(function($model) {
                return $this->fillPagination( $model );
            })->toArray();

        return customPagination( $data,  $items);
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
        $extension = auth()->user()->extensions();
        return ( count( $relations ) ) ? $extension->with( $relations )->findOrFail( $id ) : $extension->findOrFail( $id ) ;
    }

    public function fillArray( $extension )
    {
        return [
            'id'                => isset( $extension->{ primaryKey() } )                            ? $extension->{ primaryKey() } : 0,
            'subject_code'      => isset( $extension->subject->{ subject_code() } )                 ? $extension->subject->{ subject_code() } : 0,
            'subject_name'      => isset( $extension->subject->{ subject_name() } )                 ? $extension->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   => isset( $extension->subject->{ subject_credits() } )              ? $extension->subject->{ subject_credits() } : 0,
            'subject_program'   => isset( $extension->subject->programs[0]->{ program_name() } )    ? $extension->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'total_cost'        => isset( $extension->total_cost )                                  ? toMoney( $extension->total_cost ) : toMoney( 0 ),
            'status'            => isset( $extension->status->{ status_name() } )                   ? $extension->status->{ status_name() } : __('financial.generic.empty'),
            'unit_cost'         => isset( $extension->cost->{ cost() } )                            ? $extension->cost->cost_to_money : toMoney( 0 ),
            'teacher'           => isset( $extension->subject->teachers[0]->full_name )             ? $extension->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'phone'             => isset( $extension->subject->teachers[0]->phone )                 ? $extension->subject->teachers[0]->phone : __('financial.generic.empty'),
            'email'             => isset( $extension->subject->teachers[0]->email )                 ? $extension->subject->teachers[0]->email : __('financial.generic.empty'),
            'approve_date'      => isset( $extension->{ approval_date() } )                         ? $extension->{ approval_date() }->format('Y-m-d H:i:s ') : null,
            'approve_by'        => isset( $extension->secretary->full_name )                        ? $extension->secretary->full_name : __('financial.generic.empty'),
            'extension_date'    => isset( $extension->{ realization_date() } )                      ? $extension->{ realization_date() }->format('Y-m-d H:i:s ') : null,
            'student'           => isset( $extension->student->full_name )                          ? $extension->student->full_name : __('financial.generic.empty'),
            'student_phone'     => isset( $extension->student->phone )                              ? $extension->student->phone : __('financial.generic.empty'),
            'student_email'     => isset( $extension->student->email )                              ? $extension->student->email : __('financial.generic.empty'),
            'created_at'        => isset( $extension->{ created_at() } )                            ? $extension->{ created_at() }->format('Y-m-d H:i:s ') : null,
        ];
    }

    public function fillPagination( $model )
    {
        return [
            'id'                =>  isset( $model->{ primaryKey() } ) ? $model->{ primaryKey() } : 0,
            'approval_date'     =>  isset( $model->{ approval_date() } ) ? $model->{ approval_date() }->format('Y-m-d H:i:s ') : null,
            'realization_date'  =>  isset( $model->{ realization_date() } ) ? $model->{ realization_date() }->format('Y-m-d H:i:s ') : null,
            'created_at'        =>  isset( $model->{ created_at() } ) ? $model->{ created_at() }->format('Y-m-d H:i:s ') : null,
            'subject_code'      =>  isset( $model->subject->{ subject_code() } ) ? $model->subject->{ subject_code() } : 0,
            'subject_name'      =>  isset( $model->subject->{ subject_name() } ) ? $model->subject->{ subject_name() } : __('financial.generic.empty'),
            'subject_credits'   =>  isset( $model->subject->{ subject_credits() } ) ? $model->subject->{ subject_credits() } : 0,
            'program_name'      =>  isset( $model->subject->programs[0]->{ program_name() } ) ? $model->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
            'status_name'       =>  isset( $model->status->{ status_name() } ) ? $model->status->{ status_name() } : __('financial.generic.empty'),
            'teacher_name'      =>  isset( $model->subject->teachers[0]->full_name ) ? $model->subject->teachers[0]->full_name : __('financial.generic.empty'),
            'teacher_picture'   =>  isset( $model->subject->teachers[0]->profile_picture ) ? $model->subject->teachers[0]->profile_picture : iconHash(),
            'teacher_phone'     =>  isset( $model->subject->teachers[0]->phone ) ? $model->subject->teachers[0]->phone : __('financial.generic.empty'),
            'teacher_email'     =>  isset( $model->subject->teachers[0]->email ) ? $model->subject->teachers[0]->email : __('financial.generic.empty'),
            'secretary_name'    =>  isset( $model->secretary->full_name ) ? $model->secretary->full_name : __('financial.generic.empty'),
            'secretary_picture' =>  isset( $model->secretary->profile_picture ) ? $model->secretary->profile_picture : iconHash(),
            'secretary_phone'   =>  isset( $model->secretary->phone ) ? $model->secretary->phone : __('financial.generic.empty'),
            'secretary_email'   =>  isset( $model->secretary->email ) ? $model->secretary->email : __('financial.generic.empty'),
            'student_name'      =>  isset( $model->student->full_name ) ? $model->student->full_name : __('financial.generic.empty'),
            'student_picture'   =>  isset( $model->student->profile_picture ) ? $model->student->profile_picture : iconHash(),
            'student_phone'     =>  isset( $model->student->phone ) ? $model->student->phone : __('financial.generic.empty'),
            'student_email'     =>  isset( $model->student->email ) ? $model->student->email : __('financial.generic.empty'),
            'cost'              =>  isset( $model->cost->cost_to_money ) ? $model->cost->cost_to_money : toMoney( 0 ),
            'total_cost'        =>  isset( $model->total_cost ) ? toMoney( $model->total_cost ) : toMoney( 0 ),
            'comments_count'    =>  isset( $model->comments_count ) ? $model->comments_count : 0
        ];
    }
}