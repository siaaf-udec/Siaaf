<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestsOptionsController extends Controller
{
    /**
     * Get a list of services
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        if ( \request()->isMethod('GET') ) {
            $key = isset($request->key) ? $request->key : null;
            $pluck = isset($request->pluck) ? $request->pluck : false;
            return response()->json(requestsList($key, $pluck), 200);
        }
        return AjaxResponse::make(__('javascript.http_status.error', ['status' => 405]), __('javascript.http_status.method', ['method' => 'GET']), '', 405);
    }
}