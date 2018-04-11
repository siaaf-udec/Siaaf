<?php

namespace App\Container\Unvinteraction\src\Controllers;

use App\Container\Unvinteraction\src\Usuario;
use App\Container\Unvinteraction\src\Carrera;
use App\Container\Unvinteraction\src\Facultad;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenio;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\EvaluacionPreguntas;
use App\Container\Unvinteraction\src\Preguntas;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\EmpresaParticipante;
use App\Container\Unvinteraction\src\Empesa;
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
    
    private $path='unvinteraction.convenios';
    //_______________________CONVENIOS________________________________
    /*funcion para mostrar la vista principal de los convenios
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function convenios(Request $request)
    {
        if ( $request->isMethod('GET')) {
            $sede = Sede::select('PK_SEDE_Sede', 'SEDE_Sede')->pluck('SEDE_Sede', 'PK_SEDE_Sede')->toArray();
            return view($this->path.'.listarConvenios', compact('sede'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista ajax de los convenios
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function conveniosAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $sede = Sede::select('PK_SEDE_Sede', 'SEDE_Sede')->pluck('SEDE_Sede', 'PK_SEDE_Sede')->toArray();
            return view($this->path.'.listarConveniosAjax', compact('sede'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista principal de los convenios por usuario
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function misConvenios(Request $request)
    {
        if ($request->isMethod('GET')) {
         return view($this->path.'.listarMisConvenios');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarMisConvenios(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $convenio= Participantes::where('FK_TBL_Usuarios_Id', '=', $request->user()->identity_no)->select('FK_TBL_Convenio_Id')
                ->with([
                        'conveniosParticipante'=>function ($query) {
                        $query->select('PK_CVNO_Convenio','CVNO_Nombre','CVNO_Fecha_Inicio','CVNO_Fecha_Fin','FK_TBL_Estado_Id','FK_TBL_Sede_Id');
                        $query->with([
                            'convenioEstado'=>function ($query) {
                                $query->select('PK_ETAD_Estado','ETAD_Estado');
                            },
                            'convenioSede'=>function ($query) {
                                $query->select('PK_SEDE_Sede','SEDE_Sede');
                            }    
                        ]);
                    }
                ])
                ->get();
            return Datatables::of($convenio)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarConvenios(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $convenio= Convenio::select('PK_CVNO_Convenio','CVNO_Nombre','CVNO_Fecha_Inicio', 'CVNO_Fecha_Fin','FK_TBL_Estado_Id','FK_TBL_Sede_Id')
                ->with([
                        'convenioSede'=>function ($query) {
                        $query->select('PK_SEDE_Sede','SEDE_Sede');

                        },
                        'convenioEstado'=>function ($query) {
                        $query->select('PK_ETAD_Estado','ETAD_Estado');

                        }
                ])->get();
            return Datatables::of($convenio)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para registrar un nuevo convenio
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function registroConvenios(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $convenio = new Convenio();
            $convenio->CVNO_Nombre= $request->CVNO_Nombre;
            $convenio->CVNO_Fecha_Inicio = $request->CVNO_Fecha_Inicio;
            $convenio->CVNO_Fecha_Fin = $request->CVNO_Fecha_Fin;
            $convenio->FK_TBL_Estado_Id = 1;
            $convenio->FK_TBL_Sede_Id = $request->FK_TBL_Sede_Id;
            $convenio->save();
            return AjaxResponse::success('¡Bien hecho!', 'Convenio Registrado correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para buscar un convenio y enviar la informacion de un convenio
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function editarConvenios(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $convenio   = Convenio::findOrFail($id);
            $sede       = Sede::select('PK_SEDE_Sede', 'SEDE_Sede')->pluck('SEDE_Sede', 'PK_SEDE_Sede')->toArray();
            $estado     = Estado::select('PK_ETAD_Estado', 'ETAD_Estado')->pluck('ETAD_Estado', 'PK_ETAD_Estado')->toArray();
            return view($this->path.'.editarConvenios', compact('convenio', 'sede', 'estado'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para registrar los nuevo datos del convenio
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarConvenios(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $convenio= Convenio::findOrFail($id);
            $convenio->CVNO_Nombre =$request->CVNO_Nombre;
            $convenio->CVNO_Fecha_Inicio =$request->CVNO_Fecha_Inicio;
            $convenio->CVNO_Fecha_Fin =$request->CVNO_Fecha_Fin;
            $convenio->FK_TBL_Estado_Id =$request->FK_TBL_Estado_Id;
            $convenio->FK_TBL_Sede_Id =$request->FK_TBL_Sede_Id;
            $convenio->save();
            return AjaxResponse::success('¡Bien hecho!', 'Datos modificados correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para la vista de listar documentos del convenio
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function documentosConvenios(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarDocumentosConvenios', compact('id'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para el envio de datos para la tabla listar documentos del convenio
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarDocumentosConvenios(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $documento = Documentacion::select('PK_DOCU_Documentacion', 'DOCU_Nombre', 'DOCU_Ubicacion')
                ->where('FK_TBL_Convenio_Id', $id)->get();
            return Datatables::of($documento)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para el envio de datos para la tabla listar particioantes del convenio
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarParticipantesConvenios(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $participante = Participantes::where('FK_TBL_Convenio_Id', '=', $id)->select('PK_PTPT_Participantes', 'FK_TBL_Usuarios_Id')
                ->with([
                        'usuariosParticipantes'=>function ($query) {
                        $query->select( 'PK_USER_Usuario','USER_FK_Users')->with([
                        'datoUsuario'=>function ($query) {
                                    $query->select('id','name','lastname','identity_no');
                                }
                            ]);
                        }
                ])

                ->get();
            return Datatables::of($participante)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para el envio de datos para la tabla listar empresas particioantes del convenio
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarEmpresasParticipantesConvenios(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $participante =  EmpresaParticipante::where('FK_TBL_Convenio_Id', '=', $id)->select('PK_EMPT_Empresa_Participante','FK_TBL_Empresa_Id')
                ->with([
                        'patricipantesEmpresas'=>function ($query) {
                        $query->select('PK_EMPS_Empresa','EMPS_Nombre_Empresa');
                        }
                ])
                ->get();
            return Datatables::of($participante)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para agregar empresas particioantes del convenio
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function empresaConvenio(Request $request, $id)
    {
       if ($request->ajax() && $request->isMethod('POST')) {
           $ident=$request->FK_TBL_Empresa;
            $conve =$id;
            // saber si el usuario se encuentra en el convenio
           if($empresa= EmpresaParticipante::where('FK_TBL_Empresa_Id','=',$ident)->where('FK_TBL_Convenio_Id','=',$conve)->count()){
               return AjaxResponse::fail('¡Lo sentimos!', 'El usuario ya pertenece ael convenio.');
            }else{
               //insertamos la empresa en el convenio
               $empresa= new EmpresaParticipante();
               $empresa->FK_TBL_Convenio_Id=$conve;
               $empresa->FK_TBL_Empresa_Id=$ident;
               $empresa->save();
               return AjaxResponse::success('¡Bien hecho!', 'Empresa agregada correctamente.');
           }
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
        //saber si el usuario existe
            $identi=$request->identity_no;
            $conve =$id;
            if($usuario=user::where('identity_no','=',$identi)->select('id')->count()){
                //saber si se encuntra en el modulo
                if(!$usuariomodulo= Usuario::where('USER_FK_Users','=',$identi)->count()){
                    //insertamos el usuario al modulo
                    $usuariomodulo= new Usuario();
                    $usuariomodulo->PK_USER_Usuario = $identi;
                    $usuariomodulo->USER_FK_Users = $identi;
                    $usuariomodulo->save();
                    //insertamos el usuario en el convenio
                    $participante= new Participantes();
                    $participante->FK_TBL_Convenio_Id=$conve;
                    $participante->FK_TBL_Usuarios_Id=$identi;
                    $participante->save();
                    return AjaxResponse::success('¡Bien hecho!', 'Usuario agregado correctamente.');

                }else{
                    // saber si el usuario se encuentra en el convenio
                    if($participante= Participantes::where('FK_TBL_Usuarios_Id','=',$identi)->where('FK_TBL_Convenio_Id','=',$conve)->count()){
                        return AjaxResponse::fail('¡Lo sentimos!', 'El usuario ya pertenece ael convenio.');
                    }else{
                        $participante= new Participantes();
                        $participante->FK_TBL_Convenio_Id=$conve;
                        $participante->FK_TBL_Usuarios_Id=$identi;
                        $participante->save();
                        return AjaxResponse::success('¡Bien hecho!', 'Usuario agregado correctamente.');
                    }
                }
            }else{
                return AjaxResponse::fail('¡Lo sentimos!', 'El usuario no se encuentra registrado.');
            }
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
       
    }
    
    
    //______________________END___CONVENIOS____________________________
}
