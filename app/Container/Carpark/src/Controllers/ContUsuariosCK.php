<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use Illuminate\Support\Facades\DB;
use App\Container\Carpark\src\ModUserCK;
use App\Container\Overall\Src\Facades\AjaxResponse;

class ContUsuariosCK extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('humtalent.funcionario.registroFuncionario');
        return view('carpark.usuariosCK.registrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      ModUserCK::create([
          'PK_CK_Cedula'          => $request['PK_CK_Cedula' ],
          'CK_Nombres'            => $request['CK_Nombres'],
          'CK_Apellidos'          => $request['CK_Apellidos'],
          'CK_Telefono'           => $request['CK_Telefono'],
          'CK_Correo'             => $request['CK_Correo'],
          'CK_Direccion'          => $request['CK_Direccion'],
          'CK_Ciudad'             => $request['CK_Ciudad'],
          'CK_Codigo'             => $request['CK_Codigo'],
          'CK_IdPrograma'         => $request['CK_IdPrograma'],
      ]);

      $notification=array(
            'message'=>'El nuevo usuario ha sido creado correctamente.',
          'alert-type'=>'success'
      );
      return back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
