<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Constants\ConstantExtensionStatus;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\ValidationRepository;
use App\Http\Controllers\Controller;

class ApprovalValidationController extends Controller
{
    /**
     * @var ValidationRepository
     */
    private $validationRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param ValidationRepository $validationRepository
     */
    public function __construct(ValidationRepository $validationRepository)
    {
        $this->validationRepository = $validationRepository;
    }

    /**
     * Return a sidebar withs counts and status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sidebar()
    {
        $status = $this->validationRepository->availableStatus();
        $sidebar[] = [
            'id'    =>  null,
            'count' =>  $this->validationRepository->getModel()->count(),
            'text'  =>  toUpper( __( 'validation.attributes.all' ) ),
            'class' =>  randomClassesBadge()
        ];
        foreach ( $status as $status ) {
            $sidebar[] = [
                'id'    =>  $status->{primaryKey()},
                'count' =>  $this->validationRepository->count( [ $status->{ primaryKey() } ] ),
                'text'  =>  $status->{ status_name() },
                'class' =>  randomClassesBadge()
            ];
        }
        return response()->json( isset($sidebar) ? $sidebar : [], 200 );
    }

    /**
     * Get all validations with paginate and status
     *
     * @param null $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function validations( $status = null )
    {
        return response()->json(
            $this->validationRepository->getAllPaginate( 10, $status ),
            200 );
    }
}