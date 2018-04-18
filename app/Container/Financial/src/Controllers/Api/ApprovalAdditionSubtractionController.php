<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Http\Controllers\Controller;

class ApprovalAdditionSubtractionController extends Controller
{
    /**
     * @var AddSubRepository
     */
    private $addSubRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param AddSubRepository $addSubRepository
     */
    public function __construct(AddSubRepository $addSubRepository)
    {
        $this->addSubRepository = $addSubRepository;
    }

    /**
     * Return a sidebar withs counts and status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sidebar()
    {
        $status = $this->addSubRepository->availableStatus();
        $sidebar[] = [
            'id'    =>  null,
            'count' =>  $this->addSubRepository->getModel()->count(),
            'text'  =>  toUpper( __( 'validation.attributes.all' ) ),
            'class' =>  randomClassesBadge()
        ];
        foreach ( $status as $status ) {
            $sidebar[] = [
                'id'    =>  $status->{primaryKey()},
                'count' =>  $this->addSubRepository->count( [ $status->{ primaryKey() } ] ),
                'text'  =>  $status->{ status_name() },
                'class' =>  randomClassesBadge()
            ];
        }
        return response()->json( isset($sidebar) ? $sidebar : [], 200 );
    }

    /**
     * Get all additions and subtractions with paginate and status
     *
     * @param null $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function additionsSubtractions($status = null )
    {
        return response()->json(
            $this->addSubRepository->getAllPaginate( 10, $status ),
            200 );
    }
}