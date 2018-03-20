<?php

namespace App\Container\Unvinteraction\src\Controllers;

use App\Container\Unvinteraction\src\Usuarios;
use App\Container\Unvinteraction\src\Tipo_Usuario;
use App\Container\Unvinteraction\src\Estado_Usuario;
use App\Container\Unvinteraction\src\Carrera;
use App\Container\Unvinteraction\src\Facultad;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenios;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\Preguntas;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\Empresas_Participantes;
use App\Container\Unvinteraction\src\Empresa;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Unvinteraction\src\Documentacion_Extra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;

class controllerAdministrador extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    private $path='unvinteraction'; 
    //_____________________SEDES____________________
    /*funcion para mostrar la vista principal de las sedes
    *@return \Illuminate\Http\Response
    *
    */
    public function sedes()
    {
        return view($this->path.'.Listar_Sedes');
    }
    
    /*funcion para mostrar la vista ajax de las sedes
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function sedesAjax()
    {
        return view($this->path.'.Listar_Sedes_Ajax');
    }
    
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
    public function listarSedes()
    {
        //
         $Sedes=Sede::all();
         return Datatables::of($Sedes)->addIndexColumn()->make(true);
    }
   
    /*funcion para registrar una nueva sede
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function resgistrarSedes(Request $request)
    {
          if($request->ajax() && $request->isMethod('POST'))
        {
            $Sede = new Sede();
            $Sede->SEDE_Sede= $request->SEDE_Sede;
            $Sede->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'empresa agregada correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    /*funcion para buscar una sede y enviar la informacion 
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function editarSedes($id)
    {
        $Sede=Sede::findOrFail($id);
        return view($this->path.'.Editar_Sedes', compact('Sede'));
    }
    
    /*funcion para registrar los nuevo datos dela sede
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
     public function  modificarSedes(Request $request, $id)
    {
         if($request->ajax() && $request->isMethod('POST')){
             $Sede= Sede::findOrFail($id);
             $Sede->save();
             return AjaxResponse::success(
                 '¡Bien hecho!',
                 'Sede editada correctamente.'
             );
         }
         else{
             return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    //______________________END_SEDES_________
    //________________________EMPRESAS____________________
     
    /*funcion para mostrar la vista principal de las empresas
    *@return \Illuminate\Http\Response
    *
    */
    public function empresas()
    {
        //
        return view($this->path.'.Listar_Empresas');
    }
    /*funcion para mostrar la vista ajax de las empresas
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function empresasAjax()
    {
        //
        return view($this->path.'.Listar_Empresas_Ajax');
    }
    /*funcion para registrar una nueva empresa
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function listarEmpresas()
    {
        //
        $Empresa = Empresa::all();
        return Datatables::of($Empresa)->addIndexColumn()->make(true);
    }
   /*funcion para registrar una nueva empresa
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function registroEmpresa(Request $request)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
            $Empresa = new Empresa();
            $Empresa->PK_EMPS_Empresa = $request->PK_EMPS_Empresa;
            $Empresa->EMPS_Nombre_Empresa= $request->EMPS_Nombre_Empresa;
            $Empresa->EMPS_Razon_Social = $request->EMPS_Razon_Social;
            $Empresa->EMPS_Telefono = $request->EMPS_Telefono;
            $Empresa->EMPS_Direccion = $request->EMPS_Direccion;
            $Empresa->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'empresa agregada correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /*funcion para buscar una empresa y enviar la informacion 
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function editarEmpresa($id)
    {
        $Empresa = Empresa::findOrFail($id);
        return view($this->path.'.Editar_Empresa', compact('Empresa'));
    }
    /*funcion para registrar los nuevo datos dela empresa
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarEmpresa(Request $request, $id)
    { 
        if($request->ajax() && $request->isMethod('POST'))
        {
        $Empresa= Empresa::findOrFail($id);
        $Empresa->EMPS_Nombre_Empresa =$request->EMPS_Nombre_Empresa;
        $Empresa->EMPS_Razon_Social =$request->EMPS_Razon_Social;
        $Empresa->EMPS_Telefono =$request->EMPS_Telefono;
        $Empresa->EMPS_Direccion =$request->EMPS_Direccion;
        $Empresa->save();
         return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //____________________END___EMPRESAS___________________
    //___________________ESTADOS___________________________
    /*funcion para mostrar la vista principal de las Estados
    *@return \Illuminate\Http\Response
    *
    */
    public function estados()
    {
        //
        return view($this->path.'.Listar_Estados');
    }
    /*funcion para mostrar la vista ajax de las Estados
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
     public function estadosAjax()
    {
        //
        return view($this->path.'.Listar_Estados_Ajax');
    }
    /*funcion para registrar una nueva Estado
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function listarEstados()
    {
        
         $Estado= Estado ::all();
         return Datatables::of($Estado)->addIndexColumn()->make(true);
    }
   /*funcion para registrar una nueva Estado
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function resgistrarEstados(Request $request)
    {
          if($request->ajax() && $request->isMethod('POST'))
        {
            $Estado = new Estado();
            $Estado->ETAD_Estado= $request->ETAD_Estado;
            $Estado->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'Estado Agregado correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /*funcion para buscar una Estado y enviar la informacion 
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function editarEstado($id)
    {
        $Estado = Estado :: findOrFail($id);
        return view($this->path.'.Editar_Estados', compact('Estado'));
    }
    /*funcion para registrar los nuevo datos dela Estado
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarEstados(Request $request, $id)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
        $Estado= Estado ::findOrFail($id);
        $Estado->ETAD_Estado =$request->ETAD_Estado;
        $Estado->save();
         return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //_________________END___ESTADOS______________________
   
    
}
