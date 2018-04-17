<?php

namespace App\Container\Unvinteraction\src\Controllers;

use App\Container\Unvinteraction\src\Usuarios;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenios;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\EvaluacionPreguntas;
use App\Container\Unvinteraction\src\Preguntas;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\Empresa;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Unvinteraction\src\DocumentacionExtra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;

class ControllerAdministrador extends Controller
{
    
    private $path='unvinteraction.administrador'; 
    //_____________________SEDES____________________
    /*funcion para mostrar la vista principal de las sedes
    * @param  \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function sedes(Request $request)
    {
        if($request->isMethod('GET')){
            return view($this->path.'.listarSedes');
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    
    /*funcion para mostrar la vista ajax de las sedes
    * @param  \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function sedesAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarSedesAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*funcion para envio de los datos para la tabla de datos
    * @param  \Illuminate\Http\Request
    *
    * @return \App\Container\Overall\Src\Facades\AjaxResponse | Yajra\DataTables\DataTable
    * 
    */
    public function listarSedes(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $sedes=Sede::all();
            return Datatables::of($sedes)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
   
    /*funcion para registrar una nueva sede
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function resgistrarSedes(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $sede = new Sede();
            $sede->SEDE_Sede= $request->SEDE_Sede;
            $sede->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'sede agregada correctamente.'
            );
        }
        return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
    }
    
    /*funcion para buscar una sede y enviar la informacion 
    *@param int id 
    *@param  \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function editarSedes(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $sede=Sede::findOrFail($id);
            return view($this->path.'.editarSedes', compact('sede'));
        }
        return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
    }
    
    /*funcion para registrar los nuevo datos dela sede
    *@param int id
    *@param  \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
     public function  modificarSedes(Request $request, $id)
    {
         if($request->ajax() && $request->isMethod('POST')){
             $sede= Sede::findOrFail($id);
             $sede->save();
             return AjaxResponse::success(
                 '¡Bien hecho!',
                 'Sede editada correctamente.'
             );
         }
         return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
         );
       
    }
    
    //______________________END_SEDES_________
    //________________________EMPRESAS____________________
     
    /*funcion para mostrar la vista principal de las empresas
    * @param  \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function empresas(Request $request)
    {
        if($request->isMethod('GET')){
            return view($this->path.'.listarEmpresas');
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista ajax de las empresas
    * @param  \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function empresasAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarEmpresasAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para listar las empresas
    * @param  \Illuminate\Http\Request
    *
    * @return \App\Container\Overall\Src\Facades\AjaxResponse | Yajra\DataTables\DataTable
    * 
    */
    public function listarEmpresas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $empresa = Empresa::all();
            return Datatables::of($empresa)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
   /*funcion para registrar una nueva empresa
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function registroEmpresa(Request $request)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
            $empresa = new Empresa();
            $empresa->PK_EMPS_Empresa = $request->PK_EMPS_Empresa;
            $empresa->EMPS_Nombre_Empresa= $request->EMPS_Nombre_Empresa;
            $empresa->EMPS_Razon_Social = $request->EMPS_Razon_Social;
            $empresa->EMPS_Telefono = $request->EMPS_Telefono;
            $empresa->EMPS_Direccion = $request->EMPS_Direccion;
            $empresa->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'empresa agregada correctamente.'
            );
        }
        return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
    }
    
    /*funcion para buscar una empresa y enviar la informacion 
    *@param int id 
    *@param  \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function editarEmpresa(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $empresa = Empresa::findOrFail($id);
            return view($this->path.'.editarEmpresa', compact('empresa'));
        }
        return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
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
        $empresa= Empresa::findOrFail($id);
        $empresa->EMPS_Nombre_Empresa =$request->EMPS_Nombre_Empresa;
        $empresa->EMPS_Razon_Social =$request->EMPS_Razon_Social;
        $empresa->EMPS_Telefono =$request->EMPS_Telefono;
        $empresa->EMPS_Direccion =$request->EMPS_Direccion;
        $empresa->save();
         return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    
    //____________________END___EMPRESAS___________________
    //___________________ESTADOS___________________________
    
    /*funcion para mostrar la vista principal de las Estados
    * @param  \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function estados(Request $request)
    {
        if($request->isMethod('GET')){
            return view($this->path.'.listarEstados');
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista ajax de las Estados
    * @param  \Illuminate\Http\Request
    *
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
     public function estadosAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarEstadosAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*funcion para listar los Estados
    * @param  \Illuminate\Http\Request
    *
    * @return \App\Container\Overall\Src\Facades\AjaxResponse | Yajra\DataTables\DataTable
    */
    public function listarEstados(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estado= Estado ::all();
            return Datatables::of($estado)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
   /*funcion para registrar una nueva Estado
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function resgistrarEstados(Request $request)
    {
          if($request->ajax() && $request->isMethod('POST'))
        {
            $estado = new Estado();
            $estado->ETAD_Estado= $request->ETAD_Estado;
            $estado->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'Estado Agregado correctamente.'
            );
        }
        return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
            
    }
    /*funcion para buscar una Estado y enviar la informacion 
    *@param int id
    *@param  \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function editarEstado(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $estado = Estado :: findOrFail($id);
            return view($this->path.'.editarEstados', compact('estado'));
        }
        return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
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
        $estado= Estado ::findOrFail($id);
        $estado->ETAD_Estado =$request->ETAD_Estado;
        $estado->save();
         return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    //_________________END___ESTADOS______________________
   
    
}
