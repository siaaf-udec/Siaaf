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
    private $path='unvinteraction'; 
    //_____________________SEDES____________________
    public function sedes()
    {
        //
        return view($this->path.'.Listar_Sedes');
    }public function sedesAjax()
    {
        //
        return view($this->path.'.Listar_Sedes_Ajax');
    }
     public function listarSedes()
    {
        //
         $Sedes=TBL_Sede::all();
         return Datatables::of($Sedes)->addIndexColumn()->make(true);
    }
   
     public function resgistrarSedes(Request $request)
    {
          if($request->ajax() && $request->isMethod('POST'))
        {
            $Sede = new TBL_Sede();
            $Sede->Sede= $request->Sede;
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
    public function editarSedes($id)
    {
        //
        $Sede= TBL_Sede::findOrFail($id);
        return view($this->path.'.Editar_Sedes', compact('Sede'));
    }
     public function  modificarSedes(Request $request, $id)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
        $Sede= TBL_Sede::findOrFail($id);
        $Sede->Sede =$request->Sede;
        $Sede->save();
        return AjaxResponse::success(
                '¡Bien hecho!',
                'Sede editada correctamente.'
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
    
    //______________________END_SEDES_________
    //________________________EMPRESAS____________________
    public function empresas()
    {
        //
        return view($this->path.'.Listar_Empresas');
    }
    public function empresasAjax()
    {
        //
        return view($this->path.'.Listar_Empresas_Ajax');
    }
    public function listarEmpresas()
    {
        //
        $Empresa=TBL_Empresa::all();
         return Datatables::of($Empresa)->addIndexColumn()->make(true);
    }
   
    public function registroEmpresa(Request $request)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
            $Empresa = new TBL_Empresa();
            $Empresa->PK_Empresa = $request->PK_Empresa;
            $Empresa->Nombre_Empresa= $request->Nombre_Empresa;
            $Empresa->Razon_Social = $request->Razon_Social;
            $Empresa->Telefono = $request->Telefono;
            $Empresa->Direccion = $request->Direccion;
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
    public function editarEmpresa($id)
    {
        $Empresa= TBL_Empresa::findOrFail($id);
        return view($this->path.'.Editar_Empresa', compact('Empresa'));
    }
    public function modificarEmpresa(Request $request, $id)
    { 
        if($request->ajax() && $request->isMethod('POST'))
        {
        $Empresa= TBL_Empresa::findOrFail($id);
        $Empresa->Nombre_Empresa =$request->Nombre_Empresa;
        $Empresa->Razon_Social =$request->Razon_Social;
        $Empresa->Telefono =$request->Telefono;
        $Empresa->Direccion =$request->Direccion;
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
    
    public function estados()
    {
        //
        return view($this->path.'.Listar_Estados');
    }
     public function estadosAjax()
    {
        //
        return view($this->path.'.Listar_Estados_Ajax');
    }
     public function listarEstados()
    {
        //
         $Estado=TBL_Estado::all();
         return Datatables::of($Estado)->addIndexColumn()->make(true);
    }
   
     public function resgistrarEstados(Request $request)
    {
          if($request->ajax() && $request->isMethod('POST'))
        {
            $Estado = new TBL_Estado();
            $Estado->Estado= $request->Estado;
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
    public function editarEstado($id)
    {
        $Estado= TBL_Estado::findOrFail($id);
        
        return view($this->path.'.Editar_Estados', compact('Estado'));
    }
     public function modificarEstados(Request $request, $id)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
        $Estado= TBL_Estado::findOrFail($id);
        $Estado->Estado =$request->Estado;
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
