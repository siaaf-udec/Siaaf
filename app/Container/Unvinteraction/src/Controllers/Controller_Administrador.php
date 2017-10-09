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

class Controller_Administrador extends Controller
{
    private $path='unvinteraction'; 
    //_____________________SEDES____________________
    public function Sedes()
    {
        //
        return view($this->path.'.Listar_Sedes');
    }public function Sedes_Ajax()
    {
        //
        return view($this->path.'.Listar_Sedes_Ajax');
    }
     public function Listar_Sedes()
    {
        //
         $Sedes=TBL_Sede::all();
         return Datatables::of($Sedes)->addIndexColumn()->make(true);
    }
   
     public function Resgistrar_Sedes(Request $request)
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
    public function Editar_Sedes($id)
    {
        //
        $Sede= TBL_Sede::findOrFail($id);
        return view($this->path.'.Editar_Sedes', compact('Sede'));
    }
     public function  Modificar_Sedes(Request $request, $id)
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
    public function Empresas()
    {
        //
        return view($this->path.'.Listar_Empresas');
    }
    public function Empresas_Ajax()
    {
        //
        return view($this->path.'.Listar_Empresas_Ajax');
    }
    public function Listar_Empresas()
    {
        //
        $Empresa=TBL_Empresa::all();
         return Datatables::of($Empresa)->addIndexColumn()->make(true);
    }
   
    public function Registro_Empresa(Request $request)
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
    public function Editar_Empresa($id)
    {
        $Empresa= TBL_Empresa::findOrFail($id);
        return view($this->path.'.Editar_Empresa', compact('Empresa'));
    }
    public function Modificar_Empresa(Request $request, $id)
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
    
    public function Estados()
    {
        //
        return view($this->path.'.Listar_Estados');
    }
     public function Estados_Ajax()
    {
        //
        return view($this->path.'.Listar_Estados_Ajax');
    }
     public function Listar_Estados()
    {
        //
         $Estado=TBL_Estado::all();
         return Datatables::of($Estado)->addIndexColumn()->make(true);
    }
   
     public function Resgistrar_Estados(Request $request)
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
    public function Editar_Estado($id)
    {
        $Estado= TBL_Estado::findOrFail($id);
        
        return view($this->path.'.Editar_Estados', compact('Estado'));
    }
     public function  Modificar_Estados(Request $request, $id)
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
   
    public function destroy($id)
    {
        //
    }
}
