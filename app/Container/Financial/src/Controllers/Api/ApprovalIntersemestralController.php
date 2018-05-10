<?php

namespace App\Container\Financial\src\Controllers\Api;

use App\Container\Financial\src\Repository\IntersemestralRepository;
use App\Container\Overall\Src\Facades\AjaxResponse;
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

    /**
     * Return a sidebar withs counts and status
     *
     * @return \Illuminate\Http\Response
     */
    public function sidebar()
    {
        if (request()->isMethod('GET')) {
            $status = $this->intersemestralRepository->availableStatus();
            $sidebar[] = [
                'id' => null,
                'count' => $this->intersemestralRepository->getModel()->count(),
                'text' => toUpper(__('validation.attributes.all')),
                'class' => randomClassesBadge()
            ];
            foreach ($status as $status) {
                $sidebar[] = [
                    'id' => $status->{primaryKey()},
                    'count' => $this->intersemestralRepository->count([$status->{primaryKey()}]),
                    'text' => $status->{status_name()},
                    'class' => randomClassesBadge()
                ];
            }
            return response()->json(isset($sidebar) ? $sidebar : [], 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }

    /**
     * Get all intersemestrals with paginate and status
     *
     * @param null $status
     * @return \Illuminate\Http\Response
     */
    public function intersemestral( $status = null )
    {
        if ( request()->isMethod('GET') )
            return response()->json(
                $this->intersemestralRepository->getAllPaginate( 10, $status ),
                200 );

        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}