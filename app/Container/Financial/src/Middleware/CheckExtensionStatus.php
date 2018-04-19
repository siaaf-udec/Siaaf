<?php

namespace App\Container\Financial\src\Middleware;

use App\Container\Financial\src\Repository\ExtensionRepository;
use App\Container\Financial\src\Repository\StatusRequestRepository;
use Closure;

class CheckExtensionStatus
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
     * CheckExtensionStatus constructor.
     * @param ExtensionRepository $extensionRepository
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct( ExtensionRepository $extensionRepository, StatusRequestRepository $statusRequestRepository )
    {
        $this->statusRequestRepository = $statusRequestRepository;
        $this->extensionRepository = $extensionRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $model = $this->extensionRepository->getModel()
            ->select( status_fk() )
            ->find( $request->id );

        if ( isset( $model->{ status_fk() } ) ) {
            $status = $this->statusRequestRepository->getModel()->select( status_name() )->find( $model->{ status_fk() } );
        }

        if ( isset( $status->{ status_name() } ) ) {
            if ( !isEditable( $status->{ status_name() } ) ) {
                return response()->redirectToRoute( 'financial.requests.student.extension.index' );
            }
        }

        return $next($request);
    }
}