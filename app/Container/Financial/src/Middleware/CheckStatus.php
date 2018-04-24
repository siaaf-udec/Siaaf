<?php

namespace App\Container\Financial\src\Middleware;

use App\Container\Financial\src\Repository\AddSubRepository;
use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\FileRepository;
use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Financial\src\Repository\ValidationRepository;
use Closure;

class CheckStatus
{
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;
    /**
     * @var ExtensionRepository
     */
    private $extensionRepository;
    /**
     * @var ValidationRepository
     */
    private $validationRepository;
    /**
     * @var AddSubRepository
     */
    private $addSubRepository;
    /**
     * @var IntersemestralRepository
     */
    private $intersemestralRepository;
    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * CheckStatus constructor.
     * @param ExtensionRepository $extensionRepository
     * @param ValidationRepository $validationRepository
     * @param AddSubRepository $addSubRepository
     * @param FileRepository $fileRepository
     * @param IntersemestralRepository $intersemestralRepository
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct( ExtensionRepository $extensionRepository,
                                 ValidationRepository $validationRepository,
                                 AddSubRepository $addSubRepository,
                                 FileRepository $fileRepository,
                                 IntersemestralRepository $intersemestralRepository,
                                 StatusRequestRepository $statusRequestRepository )
    {
        $this->statusRequestRepository = $statusRequestRepository;
        $this->extensionRepository = $extensionRepository;
        $this->validationRepository = $validationRepository;
        $this->addSubRepository = $addSubRepository;
        $this->intersemestralRepository = $intersemestralRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        $model = $this->getModel( $type );
        $model = $model->select( status_fk() )->find( $request->id );
        if ( isset( $model->{ status_fk() } ) ) {
            $status = $this->statusRequestRepository->getModel()->select( status_name() )->find( $model->{ status_fk() } );
        }
        if ( isset( $status->{ status_name() } ) ) {
            if ( !isEditable( $status->{ status_name() } ) ) {
                return response()->redirectToRoute('home');
            }
        }
        return $next($request);
    }

    /**
     * Return the model
     *
     * @param $type
     * @return mixed
     */
    public function getModel( $type )
    {
        if ( $type == status_type_extension() ) {
            return $this->extensionRepository->getModel();
        }
        if ( $type ==  status_type_intersemestral() ) {
            return $this->intersemestralRepository->getModel();
        }
        if ( $type == status_type_validation() ) {
            return $this->validationRepository->getModel();
        }
        if ( $type == status_type_addition_subtraction() ) {
            return $this->addSubRepository->getModel();
        }
        if ( $type == status_type_file() ) {
            return $this->fileRepository->getModel();
        }
        return abort( 422 );
    }

}