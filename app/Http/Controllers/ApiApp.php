<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Container\Acadspace\src\Controllers;
use App\Container\Acadspace\src\Controllers\Api\conection;


class ApiApp extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($datos)
    {
        $database = new conection;
        $valor = $database->getDataLoggin($datos);
        return json_encode($valor);
    }
    public function qrinsert($datos)
    {
        $database = new conection;
        $valor = $database->setQr($datos);
        return json_encode($valor);
    }
    public function validarqr($datos)
    {
        $database = new conection;
        $valor = $database->validarqr($datos);
        return json_encode($valor);
    }
    public function modificardatos($datos)
    {
        $database = new conection;
        $valor = $database->modificardatos($datos);
        return json_encode($valor);
    }
    
    
}