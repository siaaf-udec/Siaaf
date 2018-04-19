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

        if ( auth()->user()->hasRole( student_role() ) ) {
            $model = auth()->user()->extensions()
                ->select( status_fk() )
                ->find( $request->supletorio );
        } elseif ( auth()->user()->hasRole( access_roles() ) ) {
            $model = $this->extensionRepository->getModel()
                        ->select( status_fk() )
                        ->find( $request->supletorio );
        }

        if ( isset( $model->{ status_fk() } ) ) {
            $status = $this->statusRequestRepository->getModel()->select( status_name() )->find( $model->{ status_fk() } );
        }

        if ( isset( $status->{ status_name() } ) ) {
            if ( $status->{ status_name() } == 'APROBADO'           ||
                 $status->{ status_name() } == 'EN ESPERA DE PAGO'  ||
                 $status->{ status_name() } == 'PAGADO'             ||
                 $status->{ status_name() } == 'CANCELADO' ) {
                return response()->redirectToRoute( 'financial.requests.student.extension.index' );
            }
        }

        return $next($request);
    }
}