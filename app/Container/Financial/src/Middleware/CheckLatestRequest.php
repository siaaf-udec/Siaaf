<?php

namespace App\Container\Financial\src\Middleware;

use App\Container\Financial\src\Repository\StatusRequestRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Closure;

class CheckLatestRequest
{
    /**
     * @var StatusRequestRepository
     */
    private $statusRequestRepository;

    /**
     * CheckLatestRequest constructor.
     * @param StatusRequestRepository $statusRequestRepository
     */
    public function __construct(StatusRequestRepository $statusRequestRepository )
    {
        $this->statusRequestRepository = $statusRequestRepository;
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
        if ( isset( $model->{ status_fk() } ) ) {
            $status = $this->statusRequestRepository->getModel()->select( status_name() )->find( $model->{ status_fk() } );
            if ( isset( $status->{ status_name() } ) && $status->{ status_name() } == sent_status() ) {
                return AjaxResponse::make(  'Aún tienes una solicitud pendiente',
                    'Ya tienes una solicitud pendiente de revisión y no es posible crear una nueva hasta que la anterior sea atendida.', '', 422);
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
            return auth()->user()->extensions()->latest()->first();
        }
        if ( $type ==  status_type_intersemestral() ) {
            return auth()->user()->intersemestrals()->latest()->first();
        }
        if ( $type == status_type_validation() ) {
            return auth()->user()->validations()->latest()->first();
        }
        if ( $type == status_type_addition_subtraction() ) {
            return auth()->user()->additionSubtraction()->latest()->first();
        }
        if ( $type == status_type_file() ) {
            return auth()->user()->filesUploaded()->latest()->first();
        }
        return abort( 422 );
    }
}