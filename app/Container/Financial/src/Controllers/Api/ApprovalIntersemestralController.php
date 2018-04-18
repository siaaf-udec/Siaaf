<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Http\Controllers\Controller;

class ApprovalIntersemestralController extends Controller
{
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param IntersemestralRepository $intersemestralRepository
     */
    public function __construct(IntersemestralRepository $intersemestralRepository)
    {

        $this->intersemestralRepository = $intersemestralRepository;
    }

    public function sidebar()
    {
        $status = $this->intersemestralRepository->availableStatus();
        $sidebar[] = [
            'id'    =>  null,
            'count' =>  $this->intersemestralRepository->getModel()->count(),
            'text'  =>  toUpper( __( 'validation.attributes.all' ) ),
            'class' =>  randomClassesBadge()
        ];
        foreach ( $status as $status ) {
            $sidebar[] = [
                'id'    =>  $status->{primaryKey()},
                'count' =>  $this->intersemestralRepository->count( [ $status->{ primaryKey() } ] ),
                'text'  =>  $status->{ status_name() },
                'class' =>  randomClassesBadge()
            ];
        }
        return response()->json( isset($sidebar) ? $sidebar : [], 200 );
    }

    public function intersemestral( $status = null )
    {
        return response()->json(
            $this->intersemestralRepository->getAllPaginate( 10, $status ),
            200 );
    }
}