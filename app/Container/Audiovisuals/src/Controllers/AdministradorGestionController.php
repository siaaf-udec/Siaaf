<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\src\Programas;
use App\Container\Audiovisuals\src\Solicitudes;
use App\Container\Audiovisuals\src\TipoArticulo;
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use App\Container\Audiovisuals\src\Validaciones;
use App\Container\Users\Src\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;


class AdministradorGestionController extends Controller
{
    //metodos solicitud prestamo
        /**
         * Funcion que muestra el registro del usuario para ingresar al prestamo
         *
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function index(Request $request)
        {
            if ($request->isMethod('GET')) {
                return view('audiovisuals.administrador.prestamoArticulo');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que registra el programa academico
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function storeProgramaAdmin(Request $request){
            if ($request->ajax() && $request->isMethod('POST')) {
                UsuarioAudiovisuales::create([
                    'USER_FK_Programa' => $request->get('FK_FUNCIONARIO_Programa'),
                    'USER_FK_User' => $request->get('idFuncionario'),
                ]);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos Verificados.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta el registro del usuario y prestamos realizados
         *
         * @param Request $request
         * @param $idFuncionarioA
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function validarFuncionario(Request $request, $idFuncionarioA)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $idFA = (int)$idFuncionarioA;
                $numeroDeprestamosMaximos = Validaciones::find(5);
                $infoFuncionario = User::with('audiovisual')
                    ->where('identity_no', '=', $idFA)->get()->first();
                if ($infoFuncionario->audiovisual != null) {
                    $idPrograma = Programas::select('PRO_Nombre', 'id')->where(
                        'id', '=', $infoFuncionario->audiovisual->USER_FK_Programa
                    )->get()->first();
                    $infoFuncionario = array_add($infoFuncionario, 'programa', $idPrograma->PRO_Nombre);
                    $infoFuncionario = array_add($infoFuncionario, 'id_programa', $idPrograma->id);
                    $infoFuncionario->id;

                    $funcionarios = Solicitudes::where([
                        ['PRT_FK_Tipo_Solicitud','=',2],
                        ['PRT_FK_Funcionario_id','=',$infoFuncionario->id],
                        ['PRT_FK_Estado','!=',3]

                    ])->get();//2=prestamos
                    $funcionarios =($funcionarios)->groupBy('PRT_Num_Orden');
                    $contador = 0;
                    foreach ($funcionarios as $le) {
                        $contador++;
                    }
                    if($contador >= $numeroDeprestamosMaximos->VAL_PRE_Valor){
                        $infoFuncionario = array_add($infoFuncionario, 'numeroPrestamos', true);
                        $infoFuncionario = array_add($infoFuncionario, 'numeroPrestamosMaximos', $numeroDeprestamosMaximos->VAL_PRE_Valor);
                    }else{
                        $infoFuncionario = array_add($infoFuncionario, 'numeroPrestamos', false);
                    }
                }
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $infoFuncionario
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta los programas academicos
         *
         * @param Request $request
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse.
         */
        public function listarProgramas(Request $request){
            if ($request->ajax() && $request->isMethod('GET')) {
                $carreras = Programas::all();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Programa registrado correctamente.',
                    json_decode($carreras)
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que valida identificacion del usuario
         *
         * @param Request $request
         * @return mixed
         */
        public function ajaxUniqueIdentificacion(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                if (User::where('identity_no', $request->get('id_funcionario'))->exists()) {
                    return \Response::json(true);
                } else {
                    return \Response::json(false);
                }
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );

        }
    //metodos asignacion prestamo
        /**
         * Funcion que muestra la gestion de asignacion de prestamo
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function formRepeatAjaxindex(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $validaciones = Validaciones::where('id','=',7)->orwhere('id','=',8)->get();
                return view('audiovisuals.administrador.contenidoAjax.prestamoFormRepeat',
                    ['validaciones'=>$validaciones]
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta kits diponibles
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function cargarKitsSelect(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $kits = Kit::has('consultaArticulos')->where('KIT_Nombre','!=','Ninguno')
                    ->where(function ($query){
                        $query->where('KIT_FK_Estado_id', '=', 1)
                            ->orWhere('KIT_FK_Estado_id', '=', 4);
                    })->get();
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $kits
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que modifica el estado del kit(incluye el estado de los articulos que contiene)
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function actualizarKit(Request $request, $idKit)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $kit = Kit::find($idKit);
                $kit->KIT_FK_Estado_id = 2;//prestado
                $kit->save();
                Articulo::where('FK_ART_Kit_id','=',$idKit)->update(['FK_ART_Estado_id' => 2]);//prestado
                return AjaxResponse::success(
                    '¡datos modificados !',
                    'correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que modifica el estado del kit incluye el estado de los articulos que contiene)
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function removerKit(Request $request, $idKit)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $kit = Kit::find($idKit);
                $kit->KIT_FK_Estado_id = 4;
                $kit->save();
                Articulo::where('FK_ART_Kit_id','=',$idKit)->update(['FK_ART_Estado_id' => 4]);
                return AjaxResponse::success(
                    '¡datos modificados !',
                    'correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta los tipos de articulos disponibles para el prestamo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function cargarArticuloSelect(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $tiposArticulo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                    $query->where('FK_ART_Kit_id', '=', 1)->where(function ($query) {
                        $query->where('FK_ART_Estado_id', '=', 1)
                            ->orWhere('FK_ART_Estado_id', '=', 4);
                    });
                })->get();
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $tiposArticulo
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que modifica el estado del articulo
         *
         * @param Request $request
         * @param $idArticulo
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function actualizarArticulo(Request $request, $idArticulo)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $articulo = Articulo::find($idArticulo);
                $articulo->FK_ART_Estado_id= 2;
                $articulo->save();
                return AjaxResponse::success(
                    '¡datos modificados !',
                    'correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que modifica el estado del articulo
         *
         * @param Request $request
         * @param $idArticulo
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function removerArticulo(Request $request, $idArticulo)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $articulo = Articulo::find($idArticulo);
                $articulo->FK_ART_Estado_id = 4;
                $articulo->save();
                return AjaxResponse::success(
                    '¡datos modificados !',
                    'correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta el tiempo asignado del articulo
         *
         * @param Request $request
         * @param $idArticulo
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function listarTiempoArticulo(Request $request, $idArticulo)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $tiempos = Validaciones::whereHas('consultaTimepoArticulo',
                    function ($query) use ($idArticulo) {
                        $query->where('id', '=', $idArticulo);
                    })->get();
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $tiempos
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Fucnion que consulta los elemtos del kit
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function consultarArticulosKit(Request $request, $idKit){
            if($request->ajax() && $request->isMethod('GET')){
                $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo'])->where([
                    ['FK_ART_Kit_id','=',$idKit]
                ])->get();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos consultados correctamente.',
                    json_decode($articulos)

                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta el tiempo asignado del kit
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function listarTiempoKit(Request $request, $idKit)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $tiempos = Validaciones::whereHas('consultaTimepoKit',
                    function ($query) use ($idKit) {
                        $query->where('id', '=', $idKit);
                    })->get();
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $tiempos
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que registra el prestamo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function crearPrestamoRepeat(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                $infoRepeat = json_decode($request->get('infoPrestamo'));
                $numOrden = (Solicitudes::max('PRT_Num_Orden')) + 1;
                $user = Auth::user();
                $adminId = $user->id;
                foreach ($infoRepeat as $prestamo) {
                    if($prestamo->kit == true){
                        $this->consultarKit($prestamo->tipoArticulosSelect);
                        $kitSolicitado = $prestamo->tipoArticulosSelect;
                        $idArticulo=0;
                    }else{
                        $this->consultarArticulo($prestamo->tipoArticulosSelect);
                        $idArticulo = $prestamo->tipoArticulosSelect;
                        $kitSolicitado = 1;
                    }
                    $fechaInicial = new Carbon;
                    $fechaFinal = new Carbon();
                    $fechaInicial = Carbon::now();
                    $fechaFinal = Carbon::now();
                    Solicitudes::create([
                        'PRT_FK_Articulos_id' => $idArticulo,
                        'PRT_Fecha_Inicio' => $fechaInicial,
                        'PRT_Fecha_Fin' => $fechaFinal->addHour((int)($prestamo->tiempo)),
                        'PRT_FK_Funcionario_id' => $request->get('idFuncionario'),
                        'PRT_FK_Kits_id' => $kitSolicitado,
                        'PRT_Observacion_Entrega' => $prestamo->observacionEntrega,
                        'PRT_Observacion_Recibe' => '',
                        'PRT_FK_Estado' => 2,//prestado
                        'PRT_FK_Tipo_Solicitud' => 2,//prestamo
                        'PRT_FK_Administrador_Entrega_id' => $adminId,
                        'PRT_FK_Administrador_Recibe_id' => 0,
                        'PRT_Num_Orden' => $numOrden,
                        'PRT_Cantidad' => $prestamo->tiempo
                    ]);
                }
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Prestamo registrado correctamente.'
                );

            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que cambia el estado del articulo
         *
         * @param $idArticulo
         */
        public function consultarArticulo($idArticulo)
        {
            $articulo = Articulo::find($idArticulo);
            $articulo->FK_ART_Estado_id= 2;
            $articulo->save();

        }
        /**
         * Funcion que cambia el estado del kit
         *
         * @param $idKit
         */
        public function consultarKit($idKit)
        {
            $kit = Kit::find($idKit);
            $kit->KIT_FK_Estado_id = 2;
            $kit->save();
            Articulo::where('FK_ART_Kit_id','=',$idKit)->update(['FK_ART_Estado_id' => 2]);
        }
        /**
         * Funcion que muestra el registro del usuario para ingresar al prestamo por medio de una peticion ajax
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexjax(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
                $tipo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                    $query->where('FK_ART_Estado_id', '=', 1)->orWhere('FK_ART_Estado_id', '=', 4);
                })->pluck('TPART_Nombre', 'id');
                return view('audiovisuals.administrador.contenidoAjax.prestamoArticuloAjax',
                    [
                        'tipoArticulos' => $tipo->toArray(),
                        'carrerasUdec' => $carreras->toArray(),
                    ]
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    //metodos finalizacion solicitudes
        /**
         * Funcion que muestra la vista de las solicitudes generadas
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function indexSolitudPrestamos(Request $request)
        {
            if ($request->isMethod('GET')) {
                $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
                return view('audiovisuals.administrador.gestionPrestamos',
                    [
                        'programas' => $carreras->toArray(),
                    ]
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que lista los prestamos y los envía al datatable correspondiente.
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function dataListarFuncionariosPrestamos(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $funcionarios = Solicitudes::with(['consultaUsuarioAudiovisuales'=> function($query){
                    return $query->select('id','USER_FK_User')->with(['user'=>function($query){
                            return $query->select(
                                'id','name','lastname','email','identity_type',
                                'identity_no'
                            );
                        }
                        ]
                    );
                }])->where([
                    ['PRT_FK_Tipo_Solicitud','=',2]
                    //['PRT_FK_Estado','!=',3]
                ])->get();//2=prestamos
                $funcionarios =($funcionarios)->groupBy('PRT_Num_Orden');
                $array = array();
                foreach ($funcionarios as $le) {
                    array_push($array, $le[0]);
                }
                return DataTables::of($array)
                    ->addIndexColumn()
                    ->make(true);
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que muestra el prestamo solicitado por el usuario
         *
         * @param Request $request
         * @param $idNumorden
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexEntregaPrestamos(Request $request, $idNumorden){
            if ($request->ajax() && $request->isMethod('GET')) {
                $prestamos = Solicitudes::with(['consultaArticulos'=> function($query){
                    return $query->select('id','FK_ART_Tipo_id','ART_Codigo')
                        ->with([
                            'consultaTipoArticulo'=>function($query){
                                return $query->select(
                                    'id','TPART_Nombre' );
                            }
                        ]);
                },'consultaKitArticulo'])->where([
                    ['PRT_Num_Orden','=',$idNumorden],
                    ['PRT_FK_Tipo_Solicitud','=',2]//prestamos
                ])->get();
                $array2 = array();
                foreach ($prestamos as $fila) {
                    $fechaEntrega = new Carbon();
                    $fechaEntrega = Carbon::parse($fila['PRT_Fecha_Fin']);
                    $fechaActual = new Carbon();
                    $fechaActual = Carbon::now();
                    $diferenciaSegundos = $fechaEntrega->diffInSeconds($fechaActual);
                    $diferenciaSegundos = floor($diferenciaSegundos/3600).gmdate(":i:s",$diferenciaSegundos % 3600);
                    $array = array_add($fila, 'tiemporestante', $diferenciaSegundos);
                    $array = array_add($array, 'sancion',($fechaEntrega > $fechaActual));
                    array_push($array2,$array);
                }
                return view('audiovisuals.administrador.contenidoAjax.ajaxEntregarPrestamo',[
                    'prestamos'=>$array2,
                    'contador'=>0
                ]);
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    //metodos gestion modificacion finalizacion prestamo
        /**
         * Funcion que relaiza el registro de la devolucion del prestamo
         *
         * @param $idSolicitud
         * @param $dataObservation
         */
        public function updateSolicitud(Request $request, $idSolicitud, $dataObservation){
            if ($request->ajax() && $request->isMethod('GET')) {
                $user = Auth::user();
                $id = $user->id;
                $idArt = Solicitudes::select('PRT_FK_Articulos_id')->where('id',"=",$idSolicitud)->get();
                $solitud = Solicitudes::where('id',"=",$idSolicitud)
                    ->update( [
                        'PRT_Observacion_Recibe' => $dataObservation,
                        'PRT_FK_Administrador_Recibe_id' => $id,
                        'PRT_FK_Estado' => 3
                    ]);
                $solicitudEliminar = Solicitudes::find($idSolicitud);
                $solicitudEliminar -> delete();
                Articulo::where('id','=',$idArt[0]['PRT_FK_Articulos_id'])->update(['FK_ART_Estado_id'=>4]);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud modificada correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que muestra la vista de las solicitudes generadas por medio de una peticion ajax
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexGestionPrestamosAjax(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                return view('audiovisuals.administrador.contenidoAjax.gestionPrestamosAjax');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta los elementos de un kit
         *
         * @param Request $request
         * @param $idSolicitud
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function consultarArticulosKitAdmin(Request $request, $idSolicitud){
            if($request->ajax() && $request->isMethod('GET')){
                $kitId = Solicitudes::select('PRT_FK_Kits_id')->where('id','=',$idSolicitud)->get();
                $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo'])->where([
                    ['FK_ART_Kit_id','=',$kitId[0]['PRT_FK_Kits_id']]
                ])->get();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos consultados correctamente.',
                    json_decode($articulos)

                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que valida el tiempo que se va aumentar a la solicitud y retorna el tiempo correspondiente
         *
         * @param Request $request
         * @param $idPrestamo
         * @param $numHoras
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function aumentarTiempoSolicitud(Request $request, $idPrestamo, $numHoras){
            if ($request->ajax() && $request->isMethod('GET')) {
                $prestamos = Solicitudes::where('id','=',$idPrestamo)->get();
                $identificacionArticulo = $prestamos[0]['PRT_FK_Articulos_id'];
                if( $identificacionArticulo != 0){
                    $articuloTiempo = Articulo::with(
                        ['consultaTipoArticulo'=> function($query){
                            return $query->select('TPART_Tiempo','id')
                                ->with(['consultarTiempoAsignado'=>function($query){
                                    return $query->select(
                                        'id','VAL_PRE_Valor' );
                                }
                                ]);
                        }])->where('id','=',$identificacionArticulo)->get();
                    $idTiempoAsignado=$articuloTiempo[0]['consultaTipoArticulo']['consultarTiempoAsignado']['VAL_PRE_Valor'];
                }else{
                    $identificacionKit = $prestamos[0]['PRT_FK_Kits_id'];
                    $articuloTiempo = Kit::with(
                        ['consultarTiempoAsignadoKit'])
                        ->where('id','=',$identificacionKit)->get();
                    $idTiempoAsignado=$articuloTiempo[0]['consultarTiempoAsignadoKit']['VAL_PRE_Valor'];
                }
                $fechaActual = new Carbon();
                $fechaActual = Carbon::now();
                $fechaFin = new Carbon();
                $fechaFin = Carbon::parse($prestamos[0]['PRT_Fecha_Fin']);
                $diferenciaTimpoActual = $fechaActual->diffInSeconds($fechaFin);
                $diferenciaTimpoActual = $diferenciaTimpoActual/3600;
                if(is_int( $diferenciaTimpoActual)!=true){
                    //se suma uno porque si tiene minutos, se debe completar como si fuera una hora
                    //1:30
                    //articulo 3 tiempo limite
                    //1:30 + 1 =2 :30 ->quitamos los decimales nos queda 2 - 3(tiempo limite) =1
                    //maximo le podemos agregar una hora para completar la regla 2 : 30 si fuera el caso
                    $horasDisponibles = $idTiempoAsignado - intval($diferenciaTimpoActual+1);
                }else{
                    $horasDisponibles = $idTiempoAsignado -  $diferenciaTimpoActual;
                }
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos cargados correctamenteasdasdasd.',
                    $horasDisponibles
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que registra la devolucion del prestamo
         *
         * @param Request $request
         * @param $idOrden
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function updatePrestamoGeneral(Request $request, $idOrden){
            if ($request->ajax() && $request->isMethod('POST')) {
                $user = Auth::user();
                $id = $user->id;
                $solicitud = Solicitudes::where([
                        ['PRT_Num_Orden',"=",$idOrden],
                        ['PRT_FK_Tipo_Solicitud',"=",2]
                    ]
                )
                    ->update( [
                        'PRT_Observacion_Recibe' => $request->get('observacion'),
                        'PRT_FK_Administrador_Recibe_id' => $id,
                        'PRT_FK_Estado' => 3
                    ]);
                $consulta = Solicitudes::where('PRT_Num_Orden',"=",$idOrden)->get();
                foreach ($consulta as $row){
                    if($row['PRT_FK_Articulos_id'] == 0){
                        Kit::where('id','=',$row['PRT_FK_Kits_id'])
                            ->update(['KIT_FK_Estado_id'=>4]);
                        Articulo::where('FK_ART_Kit_id','=',$row['PRT_FK_Kits_id'])
                            ->update(['FK_ART_Estado_id'=>4]);
                    }else{
                        Articulo::where('id','=',$row['PRT_FK_Articulos_id'])
                            ->update(['FK_ART_Estado_id'=>4]);
                    }
                }
                Solicitudes::where([
                    ['PRT_Num_Orden',"=",$idOrden],
                    ['PRT_FK_Tipo_Solicitud',"=",2]
                ])->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Devolución Correcta.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
        /**
         * Funcion que registra del prestamo del kit
         *
         * @param Request $request
         * @param $idSolicitud
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function updateKitAdmin(Request $request, $idSolicitud){
            if ($request->ajax() && $request->isMethod('POST')) {
                $user = Auth::user();
                $id = $user->id;
                Solicitudes::where('id',"=",$idSolicitud)
                    ->update( [
                        'PRT_Observacion_Recibe' => $request->get('observacionKit'),
                        'PRT_FK_Administrador_Recibe_id' => $id,
                        'PRT_FK_Estado' => 3
                    ]);
                $kitId = Solicitudes::select('PRT_FK_Kits_id')->where('id','=',$idSolicitud)->get();
                $solicitudEliminar = Solicitudes::find($idSolicitud);
                $solicitudEliminar -> delete();
                Kit::where('id','=',$kitId[0]['PRT_FK_Kits_id'])->update(['KIT_FK_Estado_id'=>4]);
                Articulo::where('FK_ART_Kit_id','=',$kitId[0]['PRT_FK_Kits_id'])->update(['FK_ART_Estado_id'=>4]);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Devolución Correcta.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
        /**
         * Funcion que modifica el tiempo de la solicitud
         *
         * @param Request $request
         * @param $idPrestamo
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function modificarTiempo(Request $request, $idPrestamo){
            if ($request->ajax() && $request->isMethod('POST')) {
                $prestamos = Solicitudes::with('consultaTipoArticulo')
                    ->where('id','=',$idPrestamo)->get();
                $dtF=Carbon::parse($prestamos[0]['PRT_Fecha_Fin']);
                $dtF->addHour($request->get('hourAdd'));
                Solicitudes::where([
                    ['id', '=', $idPrestamo],
                ])->update(
                    [
                        'PRT_Fecha_Fin' => $dtF,
                    ]
                );
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud modificada Correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    //Metodos vista solcitudes reservas
        /**
         * Funcion que muestra las solicitudes reservas por medio de una peticion ajax
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function reservaIndex(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {

                return view('audiovisuals.administrador.contenidoAjax.ajaxReservas');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que lista las reservas y los envía al datatable correspondiente.
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function dataReservasFuncionarios(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $funcionarios = Solicitudes::with(['consultaUsuarioAudiovisuales'=> function($query){
                    return $query->select('id','USER_FK_User')->with(['user'=>function($query){
                            return $query->select(
                                'id','name','lastname','email','identity_type',
                                'identity_no'
                            );
                        }
                        ]
                    );
                }])->where([
                    ['PRT_FK_Tipo_Solicitud','=',1]
                ])->get();//2=prestamos
                $funcionarios =($funcionarios)->groupBy('PRT_Num_Orden');
                $array = array();
                foreach ($funcionarios as $le) {
                    array_push($array, $le[0]);
                }
                return DataTables::of($array)
                    ->addIndexColumn()
                    ->make(true);
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    //Metodos gestion solicitud reserva(entrega y finalizacion de la solicitud reserva)
        /**
         * Funcion que muestra la solicitu de la reserva por medio de una peticion ajax
         *
         * @param Request $request
         * @param $idNumorden
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function listarReservasAcciones(Request $request, $idNumorden)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $prestamos = Solicitudes::with(['consultaArticulos'=> function($query){
                    return $query->select('id','FK_ART_Tipo_id','ART_Codigo')
                        ->with([
                            'consultaTipoArticulo'=>function($query){
                                return $query->select(
                                    'id','TPART_Nombre' );
                            }
                        ]);
                },'consultaKitArticulo'])->where([
                    ['PRT_Num_Orden','=',$idNumorden]
                ])->get();
                $array2 = array();
                foreach ($prestamos as $fila) {
                    $fechaEntrega = new Carbon();//esto de carbon para que lo est ausando
                    $fechaEntrega = Carbon::parse($fila['PRT_Fecha_Fin']);
                    $fechaActual = new Carbon();
                    $fechaActual = Carbon::now();
                    $diferenciaSegundos = $fechaEntrega->diffInSeconds($fechaActual);
                    $diferenciaSegundos = floor($diferenciaSegundos/3600).gmdate(":i:s",$diferenciaSegundos % 3600);

                    $array = array_add($fila, 'tiemporestante', $diferenciaSegundos);
                    $array = array_add($array, 'sancion',($fechaEntrega > $fechaActual));
                    array_push($array2,$array);
                }
                return view('audiovisuals.administrador.contenidoAjax.ajaxReservasAcciones',[
                    'prestamos'=>$array2,
                    'contador'=>0
                ]);
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    //Metodos vista solicitudes finalizadas
        /**
         * Funcion que muestra las solicitudes finalizadas
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function indexPrestamosFinalizados(Request $request)
        {
            if ($request->isMethod('GET')) {
                return view('audiovisuals.administrador.prestamosFinalizados');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
        /**
         * Funcion que consulta las solicitudes finalizadas y los envia al datatable correspondiente
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function dataListarFuncionariosSolicitudesFinalizadas(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $funcionarios = Solicitudes::onlyTrashed()
                    ->with([
                            'consultaUsuarioAudiovisuales'=> function($query){
                                return $query->select('id','USER_FK_User')
                                    ->with(['user'=>function($query){
                                            return $query->select(
                                                'id','name','lastname','email','identity_type',
                                                'identity_no'
                                            );
                                        }
                                        ]
                                    );
                            },'conultarAdministradorEntrega','conultarAdministradorRecibe'
                        ]
                    )->where('PRT_FK_Tipo_Solicitud','=',2)
                    ->get();//2=prestamos
                $funcionarios =($funcionarios)->groupBy('PRT_Num_Orden');
                $array = array();
                foreach ($funcionarios as $le) {
                    array_push($array, $le[0]);
                }
                return DataTables::of($array)
                    ->addIndexColumn()
                    ->make(true);
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
}
