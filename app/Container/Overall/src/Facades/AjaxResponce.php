<?php

namespace App\Container\Overall\Src\Facades;

use Illuminate\Support\Facades\Facade;

class AjaxResponse extends Facade
{
    /**
     * Store a newly created resource in storage.
     *
     * @param $data
     * @param $success
     * @param $message
     *
     * @return \Illuminate\Http\Response
     */
    static function make( $data = null, $success = true, $message = null ){
        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
        ]);
    }
    static function success( $data ){
        return self::make($data);
    }
    static function fail( $message = null, $data = null ){
        return self::make($data, false, $message);
    }
}