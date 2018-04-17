<?php

namespace App\Container\Financial\src\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestsOptionsController extends Controller
{
    public function all(Request $request)
    {
        $key = isset( $request->key ) ? $request->key : null;
        $pluck = isset( $request->pluck ) ? $request->pluck : false;
        return response()->json( requestsList( $key, $pluck ), 200 );
    }
}