<?php

namespace App\Container\Unvinteraction\src\Controllers;


use App\Container\Unvinteraction\src\TBL_Usuarios;
use App\Container\Unvinteraction\src\TBL_Tipo_Usuario;
use App\Container\Unvinteraction\src\TBL_Estado_Usuario;
use App\Container\Unvinteraction\src\TBL_Carrera;
use App\Container\Unvinteraction\src\TBL_Facultad;
use App\Container\Unvinteraction\src\TBL_Documentacion;
use App\Container\Unvinteraction\src\TBL_Convenios;
use App\Container\Unvinteraction\src\TBL_Evaluacion;
use App\Container\Unvinteraction\src\TBL_Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\TBL_Preguntas;
use App\Container\Unvinteraction\src\TBL_Sede;
use App\Container\Unvinteraction\src\TBL_Estado;
use App\Container\Unvinteraction\src\TBL_Empresas_Participantes;
use App\Container\Unvinteraction\src\TBL_Empresa;
use App\Container\Unvinteraction\src\TBL_Participantes;
use App\Container\Unvinteraction\src\TBL_Documentacion_Extra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;

class Controller_Alertas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path='unvinteraction.pasante';
    public function index()
    {
        //
    }
    public function Pasante()
    {
        return view($this->path.'.Subida_archivos');
    }
    public function Listar_Pasante()
    {
        $pasante=User::select('users.name')->get() ;
        return view($this->path.'.Listar_Pasante', compact('pasante'));
    }
    public function Perfil(Request $request)
    {
        $Usuario= User::findOrFail($request->user()->id);
       $id=$request->user()->id;
        $Estado_Usuario = TBL_Estado_Usuario::join('TBL_Usuarios','TBL_Estado_Usuario.PK_Estado_Usuario','=','TBL_Usuarios.FK_TBL_Estado_Usuario')->select('TBL_Estado_Usuario.Estado')
        ->where('TBL_Usuarios.PK_usuario',$request->user()->id)->get();
        $Carrera = TBL_Carrera::join('TBL_Usuarios','TBL_Carrera.PK_Carrera','=','TBL_Usuarios.FK_TBL_Carrera')->select('TBL_Carrera.Carrera')
        ->where('TBL_Usuarios.PK_usuario',$request->user()->id)->get();
        return view($this->path.'.Editar_Usuarios', compact('Usuario','Estado_Usuario','Carrera','id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
