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

class Controller_Convenios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $path='unvinteraction';
    
    
    //_______________________CONVENIOS________________________________
    public function Convenios()
    {
       $Sede = TBL_Sede::select('PK_Sede','Sede')->pluck('Sede','PK_Sede')
                ->toArray();
        return view($this->path.'.Listar_Convenios',compact('Sede'));
    }
    public function Convenios_Ajax()
    {
       $Sede = TBL_Sede::select('PK_Sede','Sede')->pluck('Sede','PK_Sede')
                ->toArray();
        return view($this->path.'.Listar_Convenios_Ajax',compact('Sede'));
    }
    public function Mis_Convenios()
    {
        return view($this->path.'.listar_Mis_Convenios');
    }
     public function Listar_Mis_Convenios(Request $request)
    {
        $id=$request->user()->identity_no;
       $Convenio = TBL_Convenios::join('TBL_Participantes','TBL_Convenios.PK_Convenios','=','TBL_Participantes.FK_TBL_Convenios')
            ->join('TBL_Estado','TBL_Convenios.FK_TBL_Estado','=','TBL_Estado.PK_Estado')
             ->join('TBL_Sede','TBL_Convenios.FK_TBL_Sede','=','TBL_Sede.PK_Sede')
             ->select('TBL_Convenios.PK_Convenios','TBL_Convenios.Nombre','TBL_Convenios.Fecha_Inicio','TBL_Convenios.Fecha_Fin','TBL_Estado.Estado','TBL_Sede.Sede')->where('TBL_Participantes.FK_TBL_Usuarios','=',$id)
             ->get(); 
         return Datatables::of( $Convenio)->addIndexColumn()->make(true); 
       
    }
    public function Listar_Convenios()
    {
       $Convenio = TBL_Convenios::join('TBL_Estado','TBL_Convenios.FK_TBL_Estado','=','TBL_Estado.PK_Estado')
             ->join('TBL_Sede','TBL_Convenios.FK_TBL_Sede','=','TBL_Sede.PK_Sede')
             ->select('TBL_Convenios.PK_Convenios','TBL_Convenios.Nombre','TBL_Convenios.Fecha_Inicio','TBL_Convenios.Fecha_Fin','TBL_Estado.Estado','TBL_Sede.Sede')
             ->get(); 
         return Datatables::of( $Convenio)->addIndexColumn()->make(true); 
       
    }
   
    public function Registro_Convenios(Request $request)
    {
        
          if($request->ajax() && $request->isMethod('POST'))
        {
            $convenio = new TBL_Convenios();
            $convenio->Nombre= $request->Nombre;
            $convenio->Fecha_Inicio = $request->Fecha_Inicio;
            $convenio->Fecha_Fin = $request->Fecha_Fin;
            $convenio->FK_TBL_Estado = 1;
            $convenio->FK_TBL_Sede = $request->FK_TBL_Sede;
            $convenio->save();
             
             return AjaxResponse::success(
                '¡Bien hecho!',
                'Convenio Registrado correctamente.'
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
     public function Editar_Convenios($id)
    {
        $Convenio= TBL_Convenios::findOrFail($id);
        $Sede = TBL_Sede::select('PK_Sede','Sede')->pluck('Sede','PK_Sede')
                ->toArray();
         $Estado = TBL_Estado::select('PK_Estado','Estado')->pluck('Estado','PK_Estado')
                ->toArray();
        return view($this->path.'.Editar_Convenios', compact('Convenio','Sede','Estado'));
         
    }
    public function Modificar_Convenios(Request $request, $id)
    {   
        
         if($request->ajax() && $request->isMethod('POST'))
        {
        $convenio= TBL_Convenios::findOrFail($id);
        $convenio->Nombre =$request->Nombre;
        $convenio->Fecha_Inicio =$request->Fecha_Inicio;
        $convenio->Fecha_Fin =$request->Fecha_Fin;
        $convenio->FK_TBL_Estado =$request->FK_TBL_Estado;
        $convenio->FK_TBL_Sede =$request->FK_TBL_Sede;
         $convenio->save();
             
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
     public function Documentos_Convenios($id)
    {
        return view($this->path.'.Listar_Documentos_Convenios', compact('id'));
    }
   
      public function Listar_Documentos_Convenios($id)
    {
        $documento = TBL_Documentacion::select('TBL_Documentacion.PK_Documentacion','TBL_Documentacion.Entidad','TBL_Documentacion.Ubicacion','TBL_Documentacion.Tipo','TBL_Documentacion.Descripcion')
             ->where('FK_TBL_Convenios',$id)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
    }
     public function Listar_Participantes_Convenios($id)
    {
        //
         $participante = TBL_Participantes::join('developer.users','TBL_Participantes.FK_TBL_Usuarios','=','users.identity_no')
            ->join('TBL_Convenios','TBL_Participantes.FK_TBL_Convenios','=','TBL_Convenios.PK_Convenios')
             ->select('TBL_Participantes.PK_Participantes','TBL_Participantes.FK_TBL_Usuarios','users.name','users.lastname','users.identity_no')
             ->where('FK_TBL_Convenios',$id)->get();
        return Datatables::of($participante)->addIndexColumn()->make(true);
    }
    public function Listar_Empresas_Participantes_Convenios($id)
    {
         $EM_participante = TBL_Empresas_Participantes::join('TBL_Empresa','TBL_Empresas_Participantes.FK_TBL_Empresa','=','TBL_Empresa.PK_Empresa')
             ->select('TBL_Empresas_Participantes.PK_Empresas_Participantes','TBL_Empresa.PK_Empresa','TBL_Empresa.Nombre_Empresa')
             ->where('FK_TBL_Convenios',$id)->get();
        return Datatables::of($EM_participante)->addIndexColumn()->make(true);
    }
   
    public function Empresa_Convenio(Request $request, $id)
    {
        
          if($request->ajax() && $request->isMethod('POST'))
        {
            $Empresa = new TBL_Empresas_Participantes();
            $Empresa->FK_TBL_Empresa = $request->FK_TBL_Empresa;
            $Empresa->FK_TBL_Convenios= $request->id;
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
     public function Participante_Convenio(Request $request, $id)
    {
     
          if($request->ajax() && $request->isMethod('POST'))
        {
            $Participante = new TBL_Participantes();
            $Participante->FK_TBL_Usuarios = $request->identity_no;
            $Participante->FK_TBL_Convenios= $request->id;
            $Participante->save();
            
            
          return AjaxResponse::success(
                '¡Bien hecho!',
                'usuario agregado correctamente.'
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
    
    //______________________END___CONVENIOS____________________________
  
  
    
}
