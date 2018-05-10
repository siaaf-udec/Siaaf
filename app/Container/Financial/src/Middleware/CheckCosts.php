<?php

namespace App\Container\Financial\src\Middleware;


use App\Container\Financial\src\Repository\CostServiceRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Closure;

class CheckCosts
{
    /**
     * @var CostServiceRepository
     */
    private $costServiceRepository;

    /**
     * CheckCosts constructor.
     * @param CostServiceRepository $costServiceRepository
     */
    public function __construct(CostServiceRepository $costServiceRepository)
    {
        $this->costServiceRepository = $costServiceRepository;
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
        $available = $this->costServiceRepository->getModel()->currentCost()
                            ->where( cost_service_name(), $type )
                            ->latest( cost_valid_until() )->first();

        if ( isset( $available->{ cost_valid_until() } ) ) {
            return ( $available->{ cost_valid_until() } >= today() ) ?
                    $next( $request ) :
                    AjaxResponse::make( 'Costos no configurados',
                                    'Los costos para esta solicitud no se han cofigurado por lo tanto no se permite realizar esta acción.', '', 403 );
        }

        return AjaxResponse::make(  'Costos no configurados',
                                'Los costos para esta solicitud no se han cofigurado por lo tanto no se permite realizar esta acción.', '', 403 );
    }
}