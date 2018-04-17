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

    public function datatable()
    {
        return DataTables::of( $this->query() )
                        ->setTransformer( new AdditionSubtractionDataTableTransformer )
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
            'secretary:id,name,lastname,phone,email',
            'student:id,name,lastname,phone,email',
        ];
        if ( auth()->user()->hasRole( student_role() ) ) {
            $additionSubtraction = $this->addSubRepository->getAuth( $relation, $id );
        } else if ( auth()->user()->hasRole( access_roles() ) ) {
            $additionSubtraction = $this->addSubRepository->get( $relation, $id );
        }

        $array[] = $additionSubtraction;

        return DataTables::of( $array )
                        ->setTransformer( new AdditionSubtractionDataTableTransformer )
                        ->toJson();
    }

    public function edit( $id )
    {
        $status = $this->addSubRepository->getAuth( [], $id )->select( action_subject() )->first();
        $array = ( new SubjectProgramTransformer )->transform( $this->addSubRepository->subjectRelation( $id ) );
        $array = array_add( $array, 'subject_action', ( $status->{ action_subject() } ) ? $status->{ action_subject() } : 0 );
        return response()->json( $array , 200 );
    }
}