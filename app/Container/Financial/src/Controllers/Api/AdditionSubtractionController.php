<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Http\Controllers\Controller;
use App\Transformers\Financial\AdditionSubtractionDataTableTransformer;
use App\Transformers\Financial\SubjectProgramTransformer;
use Yajra\DataTables\DataTables;

class AdditionSubtractionController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    /**
     * @var AddSubRepository|ExtensionRepository
     */
    private $addSubRepository;


    /**
     * ExtensionController constructor.
     * @param AddSubRepository $addSubRepository
     */
    public function __construct(AddSubRepository $addSubRepository)
    {
        $this->addSubRepository = $addSubRepository;
    }

    /**
     * Return additions and subtractions query from auth user
     *
     * @return mixed
     */
    public function query()
    {
        return auth()->user()->additionSubtraction()
            ->with([
                'subject' => function ($query) {
                    return $query->with('teachers:id,name,lastname,phone,email');
                },
                'status',
                'secretary:id,name,lastname,phone,email',
                'cost'
            ])->orderBy(created_at(), 'DESC');
    }

    /**
     * Return a Datatable query format
     *
     * @return mixed
     * @throws \Exception
     */
    public function datatable()
    {
        return DataTables::of( $this->query() )
                        ->setTransformer( new AdditionSubtractionDataTableTransformer )
                        ->toJson();
    }

    /**
     * Return an specific source in datatable format
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
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
            'secretary:id,name,lastname,phone,email',
            'student:id,name,lastname,phone,email',
        ];
        if ( auth()->user()->hasRole( student_role() ) || auth()->user()->can( permission_add_sub() ) ) {
            $additionSubtraction = $this->addSubRepository->getAuth( $relation, $id );
        } else if ( auth()->user()->hasRole( access_roles() ) || auth()->user()->can( permission_add_sub_approval() ) ) {
            $additionSubtraction = $this->addSubRepository->get( $relation, $id );
        }

        $array[] = isset($additionSubtraction) ? $additionSubtraction : [];

        return DataTables::of( $array )
                        ->setTransformer( new AdditionSubtractionDataTableTransformer )
                        ->toJson();
    }

    /**
     * Return the subject primary keys relation to edit the source
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit( $id )
    {
        $status = $this->addSubRepository->getAuth( [], $id )->select( action_subject() )->first();
        $array = ( new SubjectProgramTransformer )->transform( $this->addSubRepository->subjectRelation( $id ) );
        $array = array_add( $array, 'subject_action', ( $status->{ action_subject() } ) ? $status->{ action_subject() } : 0 );
        return response()->json( $array , 200 );
    }
}