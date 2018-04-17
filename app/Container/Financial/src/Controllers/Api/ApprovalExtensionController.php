<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Constants\ConstantExtensionStatus;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Http\Controllers\Controller;

class ApprovalExtensionController extends Controller
{
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;

    /**
     * ApprovalExtensionController constructor.
     * @param ExtensionRepository $extensionRepository
     */
    public function __construct(ExtensionRepository $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }

    public function sidebar()
    {
        $status = $this->extensionRepository->availableStatus();
        $sidebar[] = [
            'id'    =>  null,
            'count' =>  $this->extensionRepository->getModel()->count(),
            'text'  =>  toUpper( __( 'validation.attributes.all' ) ),
            'class' =>  randomClassesBadge()
        ];
        foreach ( $status as $status ) {
            $sidebar[] = [
                'id'    =>  $status->{primaryKey()},
                'count' =>  $this->extensionRepository->count( [ $status->{ primaryKey() } ] ),
                'text'  =>  $status->{ status_name() },
                'class' =>  randomClassesBadge()
            ];
        }
        return response()->json( isset($sidebar) ? $sidebar : [], 200 );
    }

    public function extensions( $status = null )
    {
        return response()->json(
            $this->extensionRepository->getAllPaginate( 10, $status ),
            200 );
    }
}