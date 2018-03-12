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

class controllerConvenios extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    private $path='unvinteraction';
    //_______________________CONVENIOS________________________________
    /*funcion para mostrar la vista principal de los convenios
    *@return \Illuminate\Http\Response
    *
    */
    public function convenios()
    {
        $Sede = TBL_Sede::select('PK_Sede', 'Sede')->pluck('Sede', 'PK_Sede')->toArray();
        return view($this->path.'.Listar_Convenios', compact('Sede'));
    }
    /*funcion para mostrar la vista ajax de los convenios
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function conveniosAjax()
    {
        $Sede = TBL_Sede::select('PK_Sede', 'Sede')->pluck('Sede', 'PK_Sede')->toArray();
        return view($this->path.'.Listar_Convenios_Ajax', compact('Sede'));
    }
    /*funcion para mostrar la vista principal de los convenios por usuario
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function misConvenios()
    {
        return view($this->path.'.listar_Mis_Convenios');
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@return Yajra\DataTables\DataTable
    */
    public function listarMisConvenios(Request $request)
    {
        $Convenio= TBL_Participantes::where('FK_TBL_Usuarios', '=', $request->user()->identity_no)->select('FK_TBL_Convenios')
            ->with([
                    'convenios_Participantes'=>function ($query) {
                    $query->select('PK_Convenios','Nombre','Fecha_Inicio','Fecha_Fin','FK_TBL_Estado','FK_TBL_Sede');
                    $query->with([
                        'convenios_Estados'=>function ($query) {
                            $query->select('PK_Estado','Estado');
                        },
                        'convenios_Sedes'=>function ($query) {
                            $query->select('PK_Sede','Sede');
                        }    
                    ]);
                }
            ])
            ->get();;
        return Datatables::of($Convenio)->addIndexColumn()->make(true);
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@return Yajra\DataTables\DataTable
    */
    public function listarConvenios()
    {
        $Convenio= TBL_Convenios::select('PK_Convenios','Nombre','Fecha_Inicio', 'Fecha_Fin','FK_TBL_Sede','FK_TBL_Estado')
            ->with([
                    'convenios_Sedes'=>function ($query) {
                    $query->select('PK_Sede','Sede');
                    
                    },
                    'convenios_Estados'=>function ($query) {
                    $query->select('PK_Estado','Estado');
                    
                    }
            ])->get();
        return Datatables::of($Convenio)->addIndexColumn()->make(true);
    }
    /*funcion para registrar un nuevo convenio
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function registroConvenios(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $convenio = new TBL_Convenios();
            $convenio->Nombre= $request->Nombre;
            $convenio->Fecha_Inicio = $request->Fecha_Inicio;
            $convenio->Fecha_Fin = $request->Fecha_Fin;
            $convenio->FK_TBL_Estado = 1;
            $convenio->FK_TBL_Sede = $request->FK_TBL_Sede;
            $convenio->save();
            return AjaxResponse::success('¡Bien hecho!', 'Convenio Registrado correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para buscar un convenio y enviar la informacion de un convenio
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function editarConvenios($id)
    {
        $Convenio= TBL_Convenios::findOrFail($id);
        $Sede = TBL_Sede::select('PK_Sede', 'Sede')->pluck('Sede', 'PK_Sede')->toArray();
        $Estado = TBL_Estado::select('PK_Estado', 'Estado')->pluck('Estado', 'PK_Estado')->toArray();
        return view($this->path.'.Editar_Convenios', compact('Convenio', 'Sede', 'Estado'));
    }
    /*funcion para registrar los nuevo datos del convenio
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarConvenios(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $convenio= TBL_Convenios::findOrFail($id);
            $convenio->Nombre =$request->Nombre;
            $convenio->Fecha_Inicio =$request->Fecha_Inicio;
            $convenio->Fecha_Fin =$request->Fecha_Fin;
            $convenio->FK_TBL_Estado =$request->FK_TBL_Estado;
            $convenio->FK_TBL_Sede =$request->FK_TBL_Sede;
            $convenio->save();
            return AjaxResponse::success('¡Bien hecho!', 'Datos modificados correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para la vista de listar documentos del convenio
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function documentosConvenios($id)
    {
         return view($this->path.'.Listar_Documentos_Convenios', compact('id'));
    }
    /*funcion para el envio de datos para la tabla listar documentos del convenio
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarDocumentosConvenios($id)
    {
        $documento = TBL_Documentacion::select('PK_Documentacion', 'Entidad', 'Ubicacion')
            ->where('FK_TBL_Convenios', $id)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
    }
    /*funcion para el envio de datos para la tabla listar particioantes del convenio
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarParticipantesConvenios($id)
    {
        $participante = TBL_Participantes::where('FK_TBL_Convenios', '=', $id)->select('PK_Participantes', 'FK_TBL_Usuarios')
            ->with([
                    'usuarios_Participantes'=>function ($query) {
                    $query->select('name', 'lastname', 'identity_no');
                    }
            ])
            ->get();
        return Datatables::of($participante)->addIndexColumn()->make(true);
    }
    /*funcion para el envio de datos para la tabla listar empresas particioantes del convenio
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarEmpresasParticipantesConvenios($id)
    {
        $EM_participante =  TBL_Empresas_Participantes::where('FK_TBL_Convenios', '=', $id)->select('PK_Empresas_Participantes','FK_TBL_Empresa')
            ->with([
                    'patricipantes_Empresas'=>function ($query) {
                    $query->select('PK_Empresa','Nombre_Empresa');
                    }
            ])
            ->get();
        return Datatables::of($EM_participante)->addIndexColumn()->make(true);
    }
    /*funcion para agregar empresas particioantes del convenio
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function empresaConvenio(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $Empresa = new TBL_Empresas_Participantes();
            $Empresa->FK_TBL_Empresa = $request->FK_TBL_Empresa;
            $Empresa->FK_TBL_Convenios= $request->id;
            $Empresa->save();
            return AjaxResponse::success('¡Bien hecho!', 'empresa agregada correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para agregar particioantes del convenio
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function participanteConvenio(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $Participante = new TBL_Participantes();
            $Participante->FK_TBL_Usuarios = $request->identity_no;
            $Participante->FK_TBL_Convenios= $request->id;
            $Participante->save();
            return AjaxResponse::success('¡Bien hecho!', 'usuario agregado correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    
    
    //______________________END___CONVENIOS____________________________
}
