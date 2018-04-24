<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\src\Programas;
use App\Container\Audiovisuals\src\Solicitudes;
use App\Container\Audiovisuals\src\TipoArticulo;
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use App\Container\Audiovisuals\src\Validaciones;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Users\Src\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class FuncionarioController extends Controller
{
 //metodos vista reservas usuario
    /**
     * Funcion que muestra las solicitudes de reservas del usuario
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function solicitudReserva(Request $request){
        if ($request->isMethod('GET')) {


            return view('audiovisuals.funcionario.gestionReservas');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion que consulta las solicitudes de reservas y los envia al datatable correspondiente
     *
     * @param Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function dataListarFuncionarioReserva(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user = Auth::user();
            $id = $user->id;
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
                ['PRT_FK_Tipo_Solicitud','=',1],
                ['PRT_FK_Funcionario_id','=',$id]
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
     * Funcion que consulta el numero de reservas permitas por usuario
     *
     * @param Request $request
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function validarNumeroDeReservas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user = Auth::user();
            $id = $user->id;
            $numeroDeReservasMaximos = Validaciones::find(6);
            $infoFuncionario = User::with('audiovisual')
                ->where('id', '=', $id)->get()->first();
            if ($infoFuncionario->audiovisual != null) {
                $infoFuncionario->id;
                $funcionarios = Solicitudes::where([
                    ['PRT_FK_Tipo_Solicitud','=',1],
                    ['PRT_FK_Funcionario_id','=',$id]
                ])->get();//1=reservas
                $funcionarios =($funcionarios)->groupBy('PRT_Num_Orden');
                $contador = 0;
                foreach ($funcionarios as $le) {
                    $contador++;
                }
                if($contador >= $numeroDeReservasMaximos->VAL_PRE_Valor){
                    $infoFuncionario = array_add($infoFuncionario, 'numeroReservas', true);
                    $infoFuncionario = array_add($infoFuncionario, 'numeroMaximo', $numeroDeReservasMaximos->VAL_PRE_Valor);
                }else{
                    $infoFuncionario = array_add($infoFuncionario, 'numeroReservas', false);
                    $infoFuncionario = array_add($infoFuncionario, 'numeroMaximo', $numeroDeReservasMaximos->VAL_PRE_Valor);
                }
            }else{
                $infoFuncionario  = array_add($infoFuncionario, 'numeroReservas', false);
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
     * Funcion que muestra la solicitud de reserva para registrar por mdeio de una peticion ajax
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function reservaFormRepeatIndex(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            //consulta si el usuario logueado esxite en la tabla Audiovisuales User
            $usario = $this->consultarUsuario();
            $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
            $validaciones= Validaciones::all();
            return view('audiovisuals.funcionario.prestamoAjax.reservaFormRepeat',[
                'programas'=>$carreras->toArray(),
                'numero'=>$usario, //bandera para abrir el modal de registro del usuairo que esta logueado
                'validaciones'=>$validaciones
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion que regitra el programa del usuario
     *
     * @param Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storePrograma(Request $request){
        if ( $request->ajax() && $request->isMethod('POST') ) {
            $user    = Auth::user();
            $userid  = $user -> id;
            UsuarioAudiovisuales::create([
                'USER_FK_Programa' => $request -> get('FK_FUNCIONARIO_Programa'),
                'USER_FK_User' => $userid,
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Programa registrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
 //metodos vista registro reserva
    /**
     * Funcion que consulta los kits disponibles para la fecha de reserva
     *
     * @param Request $request
     * @param $fechaInicial
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargarKitsSelectReserva(Request $request, $fechaInicial)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $kits = Kit::where('KIT_Nombre', '!=', 'Ninguno')
                ->get();
            $current = Solicitudes::where([
                ['PRT_Fecha_Fin','>=',$fechaInicial],
                ['PRT_Fecha_Inicio','<=',$fechaInicial]])
                ->get();
            $co=0;
            $b =0;
            $array = array();
            foreach($kits as $kit){
                foreach ($current as $solicitado){
                    if($kit['id'] == $solicitado['PRT_FK_Kits_id']) {
                        $b=1;
                    }
                }
                if($b==0){
                    array_push($array,$kit);
                }
                $b=0;
                $co++;
            }
            return AjaxResponse::success(
                '¡datos consultados !',
                'correctamente.',
                $array
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion que consulta los tipos de articulos
     *
     * @param Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargarArticuloSelectReserva(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $tiposArticulo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                $query->where('FK_ART_Kit_id', '=', 1)->orwhere('FK_ART_Kit_id', '=', 4);
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
     * Funcion donde registra articulo o kit a la solicitud reserva
     *
     * @param Request $request
     * @param $idArticulo
     * @param $fechaInicial
     * @param $tiempoAsignar
     * @param $numeroOrden
     * @param $kitArticulo
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function actualizarArticuloReserva(Request $request, $idArticulo, $fechaInicial, $tiempoAsignar, $numeroOrden, $kitArticulo)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
            $fechaInicialReserva = new Carbon;
            $fechaInicialReserva = Carbon::parse($fechaInicial);
            $fechaFinalReserva = new Carbon();
            $fechaFinalReserva = Carbon::parse($fechaInicial);
            $fechaFinalReserva ->addHour((int)($tiempoAsignar));
            $current = Solicitudes::where([
                ['PRT_Fecha_Fin','>=',$fechaFinalReserva],
                ['PRT_Fecha_Inicio','<=',$fechaFinalReserva]])
                ->get();
            $b =true;
            foreach ($current as $solicitado){
                if( $idArticulo == $solicitado['PRT_FK_Articulos_id']) {
                    $b=false;
                }
            }
            if($b){
                if($kitArticulo == 'articulo'){
                    $solicitudId = Solicitudes::create([
                        'PRT_FK_Articulos_id'=> $idArticulo,
                        'PRT_Fecha_Inicio'  => $fechaInicialReserva,
                        'PRT_Fecha_Fin'     => $fechaFinalReserva,
                        'PRT_FK_Funcionario_id'=> $user->id,
                        'PRT_FK_Kits_id'=> 0,
                        'PRT_Observacion_Entrega'=> '',
                        'PRT_Observacion_Recibe'=> '',
                        'PRT_FK_Estado'=> 3,//reservado
                        'PRT_FK_Tipo_Solicitud'=> 1,//reserva->solicitud
                        'PRT_FK_Administrador_Entrega_id'=>0,
                        'PRT_FK_Administrador_Recibe_id'=>0,
                        'PRT_Num_Orden'=>$numeroOrden,
                        'PRT_Cantidad'=>1
                    ]);
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Reserva registrada correctamente.',
                        $solicitudId->id
                    );
                }else{
                    $solicitudId = Solicitudes::create([
                        'PRT_FK_Articulos_id'=> 0,
                        'PRT_Fecha_Inicio'  => $fechaInicialReserva,
                        'PRT_Fecha_Fin'     => $fechaFinalReserva,
                        'PRT_FK_Funcionario_id'=> $user->id,
                        'PRT_FK_Kits_id'=> $idArticulo,
                        'PRT_Observacion_Entrega'=> '',
                        'PRT_Observacion_Recibe'=> '',
                        'PRT_FK_Estado'=> 3,//reservado
                        'PRT_FK_Tipo_Solicitud'=> 1,//reserva->solicitud
                        'PRT_FK_Administrador_Entrega_id'=>0,
                        'PRT_FK_Administrador_Recibe_id'=>0,
                        'PRT_Num_Orden'=>$numeroOrden,
                        'PRT_Cantidad'=>1
                    ]);
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Reserva registrada correctamente.',
                        $solicitudId->id
                    );
                }
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion donde cancela el articulo o kit registrado en la solicitud reserva
     *
     * @param Request $request
     * @param $idSolicitud
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function eliminarSolicitudReser(Request $request, $idSolicitud)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitudReserva = Solicitudes::find($idSolicitud);
            $solicitudReserva->forceDelete();
            return AjaxResponse::success(
                '¡datos consultados !',
                'correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion que muestra las solicitudes de reservas del usuario por medio de una peticion ajax
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function solicitudReservaAjax(Request $request){
        if ($request->isMethod('GET')) {
            return view('audiovisuals.funcionario.prestamoAjax.gestionReservasAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion donde consulta el numero de orden de la solicitid
     *
     * @param Request $request
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function numeroOrden(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $numOrden = (Solicitudes::max('PRT_Num_Orden')) + 1;
            return AjaxResponse::success(
                '¡datos consultados !',
                'correctamente.',
                $numOrden
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion donde consulta los articulos disponibles para la fecha de la solicitud
     *
     * @param Request $request
     * @param $idTipoArticulo
     * @param $fechaInicial
     * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function codigoArticuloSelectReserva(Request $request, $idTipoArticulo, $fechaInicial)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $current = Solicitudes::where([
                ['PRT_Fecha_Fin','>=',$fechaInicial],
                ['PRT_Fecha_Inicio','<=',$fechaInicial]])
                ->get();
            $codigoArticuloss = Articulo::where([
                ['FK_ART_Kit_id','=',1],
                ['FK_ART_Tipo_id','=',$idTipoArticulo]
            ])->get();
            $co=0;
            $b =0;
            $array = array();
            foreach($codigoArticuloss as $articulo){
                foreach ($current as $solicitado){
                    if($articulo['id'] == $solicitado['PRT_FK_Articulos_id']) {
                        $b=1;
                    }
                }
                if($b==0){
                    array_push($array,$articulo);
                }
                $b=0;
                $co++;
            }
            return AjaxResponse::success(
                '¡datos consultados !',
                'correctamente.',
                $array
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion que muestra la solicitud de la reserva del usuario
     *
     * @param Request $request
     * @param $idNumOrden
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function indexSolictudReserAsignadaAjax(Request $request, $idNumOrden)    {
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
                ['PRT_Num_Orden','=',$idNumOrden],
                ['PRT_FK_Tipo_Solicitud','=',1]//reservas
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
            return view('audiovisuals.funcionario.prestamoAjax.accionesSolicitudReservaFormRepeatAjax',[
                'prestamos'=>$array2,
                'contador'=>0
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Funcion que consulta la fecha de reserva y la actual para determinar que accion realizar
     * (cancelar solicitud reserva)
     *
     * @param Request $request
     * @param $idNumOrden
     * @param $accion
     * @return \Illuminate\Http\Response
     */
    public function cancelarSolictudReserva(Request $request, $idNumOrden, $accion)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            if($accion == 'validar'){
                $prestamos = Solicitudes::where([
                    ['PRT_Num_Orden','=',$idNumOrden]
                ])->get();
                $numHorasCancelar = Validaciones::select('VAL_PRE_Valor')->where('id','=',10)->get();
                $fechaEntrega = new Carbon();
                $fechaEntrega = Carbon::parse($prestamos[0]['PRT_Fecha_Inicio']);
                $fechaActual = new Carbon();
                $fechaActual = Carbon::now();
                if($fechaActual<$fechaEntrega){
                    $fechaActual->addHour($numHorasCancelar[0]['VAL_PRE_Valor']);
                    if($fechaActual>$fechaEntrega){
                        $accionn = 'NOCANCELAR';
                    }else{
                        $accionn = 'CANCELAR';
                    }
                }else{
                    $accionn = 'SANCION';
                }
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                        $accionn
                );

            }else{
                Solicitudes::where('PRT_Num_Orden','=',$idNumOrden)->forcedelete();
                return AjaxResponse::success(
                    '¡Solicitud eliminada !',
                    'correctamente.'
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Funcion que consultar y retorna informaicon del usuario logueado
     *
     * @return int
     */
    public function consultarUsuario(){
        $user    = Auth::user();
        $userid  = $user->id;
        $usuario  = UsuarioAudiovisuales::where('USER_FK_User', '=',$userid)->first();
        $bandera=1;
        if ($usuario == null) {
            $bandera = 0;
        }
        return $bandera;
    }


}
