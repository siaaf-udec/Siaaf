<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Carreras;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\src\Programas;
use App\Container\Audiovisuals\src\Solicitudes;
use App\Container\Audiovisuals\src\TipoArticulo;
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use App\Container\Audiovisuals\src\Validaciones;

use App\Container\Users\Src\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;


class AdministradorGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //FUNCION VISTA PRINCIPAL GESTION ADMINISTRADOR
    public function index()
    {
        $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
        //cargar los articulos disponibles en la vista ajax
        $tipo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
            $query->where('FK_ART_Estado_id', '=', 1);
        })->pluck('TPART_Nombre', 'id');
        return view('audiovisuals.administrador.prestamoArticulo',
            [
                'tipoArticulos' => $tipo->toArray(),
                'carrerasUdec' => $carreras->toArray(),
            ]
        );
    }
    public function reportes()
    {
        return view('audiovisuals.reporte.gestionReportes');
    }
    public function reporteCarreras(Request $request,$anio,$mes)   {
        $nombremes= array('EN','FE','MA','ABR','MAY','JUN','JUL','AGO','SEP','OCTU','NO','DIC');
        $date = date("d/m/Y");
        $time = date("h:i A");
        $carreras = Programas::all()->pluck('PRO_Nombre');
        $tipoArticulo = TipoArticulo::all()->pluck('TPART_Nombre');
        $empleados = Articulo::whereNotNull('created_at', null)->orderBy('ART_Descripcion', 'asc')->get();
        $total = count($empleados);
        $cont = 1;
        return view('audiovisuals.reporte.ReporteCarreras',
            [
                'empleados'=>$empleados->toArray(),
                'date'=>$date ,
                'time'=>$time   ,
                'total'=>$total   ,
                'cont'=>$cont,
                'anio'=>$anio,
                'mes'=>$mes,
                'nombremes'=>$nombremes,
                'pruba'=>1,
                'carreras'=>$carreras->toArray(),
                'tipoArticulo'=>$tipoArticulo->toArray(),

            ]
        );
    }
    public function downloadCarreras($anio,$mes)
    {
        $nombremes= array('ENERO','FEBRERO','MARZO','ABRRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Articulo::whereNotNull('created_at', null)->orderBy('ART_Descripcion', 'asc')->get();
        $total = count($empleados);
        $cont = 1;
        $pdf = SnappyPdf::loadView('audiovisuals.reporte.ReporteCarreras',
            [
                'empleados'=>$empleados->toArray(),
                'date'=>$date ,
                'time'=>$time   ,
                'total'=>$total   ,
                'cont'=>$cont,
                'anio'=>$anio,
                'mes'=>$mes,
                'nombremes'=>$nombremes,
                'pruba'=>1,
            ]
        );
        $pdf->setOption('javascript-delay', 13000);
        return $pdf->download('ReporteCarreras.pdf');
    }
    public function reporteTiempoUso()
    {
        $anio = date("Y");
        $mes = date("m");
        $nombremes = array('EN','FE','MA','ABR','MAY','JUN','JUL','AGO','SEP','OCTU','NO','DIC');
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Articulo::whereNotNull('created_at', null)->orderBy('ART_Descripcion', 'asc')->get();
        $total = count($empleados);
        $cont = 1;
        return view('audiovisuals.reporte.TiempoUsoArticulos',
            compact('empleados', 'date', 'time', 'cont'),
            [
                'total'=>$total,
            ]
        );
    }
    public function downloadTiempoUso()
    {
        $anio = date("Y");
        $mes = date("m");
        $nombremes = array('ENERO','FEBRERO','MARZO','ABRRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Articulo::whereNotNull('created_at', null)->orderBy('ART_Descripcion', 'asc')->get();
        $total = count($empleados);
        $cont = 1;
        return SnappyPdf::loadView('audiovisuals.reporte.TiempoUsoArticulos',
            compact('empleados', 'date', 'time', 'cont'),
            [
                'total'=>$total ,
            ]
        )->download('ReporteCarreras.pdf');
    }
    public function indexjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
            //cargar los articulos disponibles en la vista ajax
            $tipo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                $query->where('FK_ART_Estado_id', '=', 1);
            })->pluck('TPART_Nombre', 'id');
            return view('audiovisuals.administrador.contenidoAjax.prestamoArticuloAjax',
                [
                    'tipoArticulos' => $tipo->toArray(),
                    'carrerasUdec' => $carreras->toArray(),
                ]
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    }
    public function indexTablaPrestamos()
    {
        $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
        return view('audiovisuals.administrador.gestionPrestamos',
            [
                'programas' => $carreras->toArray(),
            ]
        );
    }
    public function indexTablaPrestamos2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $funcionarios = Solicitudes::with(['consultaUsuarioAudiovisuales'=> function($query){
                return $query->select('id','USER_FK_User')->with(['user'=>function($query){
                        return $query->select(
                            'id','name','lastname','identity_type',
                            'identity_no','email'
                        );
                    }
                    ]
                );
            }])->get();
            $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
            return view('audiovisuals.administrador.contenidoAjax.gestionPrestamosAjax',[
                'programas' => $carreras->toArray(),
            ]);
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    }
    public function indexEntregaPrestamos(Request $request,$idNumorden){
        if ($request->ajax() && $request->isMethod('GET')) {
            $prestamos = Solicitudes::with(['consultaArticulos'=> function($query){
                return $query->select('id','FK_ART_Tipo_id')
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
            foreach ($prestamos as $player) {
                $dtF= new Carbon();//esto de carbon para que lo est ausando
                $dtF=Carbon::parse($player['PRT_Fecha_Fin']);
                $dtI = new Carbon();
                $dtI = Carbon::now();
                $difDt= $dtF->diffInHours($dtI);
                if($difDt==0){
                    $difDt=$dtF->diffInMinutes($dtI);
                }
                $array = array_add($player, 'tiemporestante', $difDt);
                array_push($array2,$array);
            }
            return view('audiovisuals.administrador.contenidoAjax.ajaxEntregarPrestamo',[
                'prestamos'=>$array2,
                'contador'=>0
            ]);
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    }
    public function updateSolicitud($idSolicitud,$dataObservation){
        $user = Auth::user();
        $id = $user->id;
        $idArt = Solicitudes::select('PRT_FK_Articulos_id')->where('id',"=",$idSolicitud)->get();
        Solicitudes::where('id',"=",$idSolicitud)
            ->update( [
                'PRT_Observacion_Recibe' => $dataObservation,
                'PRT_FK_Administrador_Recibe_id' => $id,
                'PRT_FK_Estado' => 3
            ]);
        Articulo::where('id','=',$idArt[0]['PRT_FK_Articulos_id'])->update(['FK_ART_Estado_id'=>4]);
    }
    public function updatePrestamoGeneral(Request $request,$idOrden){
        $user = Auth::user();
        $id = $user->id;
        if ($request->ajax() && $request->isMethod('POST')) {
            Solicitudes::where([
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

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Devolución Correcta.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    }
    public function updateKitAdmin(Request $request,$idSolicitud){
        $user = Auth::user();
        $id = $user->id;
        if ($request->ajax() && $request->isMethod('POST')) {
            Solicitudes::where('id',"=",$idSolicitud)
                ->update( [
                    'PRT_Observacion_Recibe' => $request->get('observacionKit'),
                    'PRT_FK_Administrador_Recibe_id' => $id,
                    'PRT_FK_Estado' => 3
                ]);
            $kitId = Solicitudes::select('PRT_FK_Kits_id')->where('id','=',$idSolicitud)->get();
             Kit::where('id','=',$kitId[0]['PRT_FK_Kits_id'])->update(['KIT_FK_Estado_id'=>4]);
             Articulo::where('FK_ART_Kit_id','=',$kitId[0]['PRT_FK_Kits_id'])->update(['FK_ART_Estado_id'=>4]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Devolución Correcta.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    }
    public function moreTimeSolicitud(Request $request,$idPrestamo,$numHoras){
        if ($request->ajax() && $request->isMethod('GET')) {
            $prestamos = Solicitudes::with('consultaTipoArticulo')
                ->where('id','=',$idPrestamo)->get();
            $idTiempoAsignado=$prestamos[0]['consultaTipoArticulo']['TPART_Tiempo'];
            $tiempos = Validaciones::select('VAL_PRE_Valor')
                ->where('id','=',$idTiempoAsignado)->get();
            $horasDisponibles=$idTiempoAsignado-$numHoras;
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamenteasdasdasd.',
                $horasDisponibles
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    public function moreTimeUpdate(Request $request,$idPrestamo){
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
                'Devolución Correcta.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
    }
    public function index2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tiempo = array(
                '0' => 'Libre', '30' => '30 Minutos', '60' => '60 Minutos',
                '90' => '90 Minutos'
            );
            $cantidadArticulos = array('1' => '1', '2' => '2', '3' => '3');
            $carreras = Programas::all()->pluck('PRO_Nombre', 'id');
            $tipo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                $query->where('FK_ART_Estado_id', '=', 1);
            })->pluck('TPART_Nombre', 'id');;
            return view('audiovisuals.funcionario.reservaArticulo', [
                'tipoArticulos' => $tipo->toArray(),
                'numeroArticulos' => $cantidadArticulos,
                'asignarTiempo' => $tiempo,
                'carrerasUdec' => $carreras->toArray()
            ]);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //FUNCION VISTA AJAX GESTION RESERVAS ADMINISTRADOR
    public function reservaIndex(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('audiovisuals.administrador.contenidoAjax.ajaxReservas');
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //FUNCION VISTA AJAX FORM REPEAT ADMINISTRADOR
    public function formRepeatAjaxindex(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tipo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                $query->where('FK_ART_Estado_id', '=', 4);
            })->pluck('TPART_Nombre', 'id');
            $kits = Kit::select('id','KIT_Nombre')->where([
                ['KIT_Nombre','!=','Ninguno'],
                ['KIT_FK_Estado_id','=',4]
                ]
            )->pluck('KIT_Nombre', 'id');
            $validaciones= Validaciones::all();
            return view('audiovisuals.administrador.contenidoAjax.prestamoFormRepeat', [
                'tipoArticulos' => $tipo->toArray(),
                'kits' => $kits->toArray(),
                'validaciones' =>$validaciones
            ]);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //listarTiempoArticulo
    public function listarTiempoArticulo(Request $request, $idFuncionario)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tiempos = Validaciones::whereHas('consultaTimepoArticulo',
                function ($query) use ($idFuncionario) {
                    $query->where('id', '=', $idFuncionario);
                })->get();
            return AjaxResponse::success(
                '¡datos consultados !',
                'correctamente.',
                $tiempos
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //FUNCION VALIRDAR FUNCIONARIO
    public function validarFuncionario(Request $request, $idFuncionarioA)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $idFA = (int)$idFuncionarioA;
            $infoFuncionario = User::with('audiovisual')
                ->where('identity_no', '=', $idFA)->get()->first();
            if ($infoFuncionario->audiovisual != null) {
                $idPrograma = Programas::select('PRO_Nombre', 'id')->where(
                    'id', '=', $infoFuncionario->audiovisual->USER_FK_Programa
                )->get()->first();
                $infoFuncionario = array_add($infoFuncionario, 'programa', $idPrograma->PRO_Nombre);
                $infoFuncionario = array_add($infoFuncionario, 'id_programa', $idPrograma->id);
            }
            return AjaxResponse::success(
                '¡datos consultados !',
                'correctamente.',
                $infoFuncionario
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function crearProgramaFuncionario(Request $request){
        if ($request->ajax() && $request->isMethod('POST')) {
            UsuarioAudiovisuales::create([
                'USER_FK_Programa'=>$request->get('FK_FUNCIONARIO_Programa'),
                'USER_FK_User'=>$request->get('idFuncionario'),
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Programa registrado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function listarProgramas(Request $request){
        if ($request->ajax() && $request->isMethod('GET')) {
            $carreras = Programas::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Programa registrado correctamente.',
                json_decode($carreras)
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //FUNCION PARA LISTAR LA DATATABLE DE RESERVAS DE LOS FUNCIONARIOS EN GESTION RESERVAS
    public function dataReservasFuncionarios(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitudes = Solicitudes::with(
                ['consultaTipoArticulo', 'consultaUsuarioAudiovisuales', 'conultarUsuarioDeveloper']
            )->where([
                ['PRT_FK_Estado', '!=', '3'],// entregado
                ['PRT_FK_Tipo_Solicitud', '=', '1']//reserva
            ])->get();
            $solicitudes =($solicitudes)->groupBy('PRT_Num_Orden');
            $array = array();
            foreach ($solicitudes as $le) {
                array_push($array, $le[0]);
            }
           // $array = json_decode($array);
            return DataTables::of($array)
                ->addColumn('Elementos', function ($solicitudes) {
                    if ($solicitudes->PRT_FK_Kits_id != 1) {
                        return "Kit";
                    } else {
                        return "Articulos";
                    }
                })
                ->addColumn('Acciones', function ($solicitudes) {
                    $fechaHoy = new Carbon();
                    $fechaReserva = new Carbon();
                    $fechaHoy = Carbon::now();
                    $fechaFin = new Carbon();
                    $fechaFin = Carbon::parse($solicitudes->PRT_Fecha_Fin);
                    $fechaReserva = Carbon::parse($solicitudes->PRT_Fecha_Inicio);
                    if($fechaHoy >= $fechaReserva  && $fechaHoy <= $fechaFin ){
                        if ($solicitudes->PRT_FK_Estado == 1) {
                            return "<a class='btn btn-simple btn-info btn-icon verReserva' id='1'><i class=\"icon-list\"></i>Ver Reserva</a>";
                        } else {
                            return "<a class='btn btn-simple btn-warning btn-icon verReserva' id='2'><i class=\"icon-list\"></i>Finalizar Reserva</a>";
                        }
                    }else{
                        if($fechaHoy <= $fechaReserva  ){
                            return "<span class='label label-sm label-warning'>No disponible</span>";
                        }
                        if($fechaHoy > $fechaFin){
                            return "<span class='label label-sm label-danger'>Sancion</span>";
                        }
                    }
                })
                ->rawColumns(['Acciones'])
                ->addIndexColumn()
                ->make(true);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function verReserva(Request $request, $idKit)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $detalle = Articulo::with('consultaTipoArticulo', 'consultaKitArticulo')->where([
                ['FK_ART_Kit_id', '=', $idKit],
            ])->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $detalle
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function verReservaArticulos(Request $request, $numOrden)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $articulos= Solicitudes::with(['consultaTipoArticulo'])->where([
                ['PRT_Num_Orden', '=', $numOrden]
            ])->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $articulos
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    //FUNCION PARA LISTAR LA DATATABLE DE ENTREGA DE PRESTAMOS DE LOS FUNCIONARIOS
    public function dataEntregaFuncionarios(Request $request){
        if ($request->ajax() && $request->isMethod('GET')) {
            $prestamos = Solicitudes::with('consultaTipoArticulo')
                ->where('PRT_FK_Tipo_Solicitud','=','2')->get();
            return DataTables::of($prestamos)
                ->addIndexColumn()
                ->make(true);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     * @param Request $request
     * @param $idReserva
     * @return \Illuminate\Http\Response
     */
    public function realizarEntregaReserva(Request $request, $numOrden)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
            $idAdmin = $user->id;
            $query = Solicitudes::select('PRT_FK_Kits_id', 'PRT_FK_Articulos_id')->where([
                ['PRT_Num_Orden', '=', $numOrden],
            ])->get();
            if ($request->get('PRT_Observacion_Recibe') == null) {
                Solicitudes::where([
                    ['PRT_Num_Orden', '=', $numOrden],
                ])->update([
                        'PRT_Observacion_Entrega' => $request->get('PRT_Observacion_Entrega'),
                        'PRT_FK_Administrador_Entrega_id' => $idAdmin,
                        'PRT_FK_Estado' => 2//prestado
                    ]
                );
                $articulo = Solicitudes::select('PRT_FK_Articulos_id','PRT_FK_Kits_id')
                    ->where('PRT_Num_Orden', '=', $numOrden)->get();
                foreach ($articulo as $id){
                    if($id->PRT_FK_Kits_id == 1){
                        Articulo::where('id','=',$id->PRT_FK_Articulos_id)
                            ->update(['FK_ART_Estado_id'=>2]);//prestado
                    }else{
                        Articulo::where('FK_ART_Kit_id','=',$id->PRT_FK_Kits_id)
                            ->update(['FK_ART_Estado_id'=>2]);//prestado
                    }
                }
            } else {
                Solicitudes::where([
                    ['PRT_Num_Orden', '=', $numOrden],
                ])->update(
                    [
                        'PRT_Observacion_Recibe' => $request->get('PRT_Observacion_Entrega'),
                        'PRT_FK_Administrador_Recibe_id' => $idAdmin,
                        'PRT_FK_Estado' => 3
                    ]
                );
                $articulo = Solicitudes::select('PRT_FK_Articulos_id','PRT_FK_Kits_id')
                    ->where('PRT_Num_Orden', '=', $numOrden)->get();
                foreach ($articulo as $id){
                    if($id->PRT_FK_Kits_id == 1){
                        Articulo::where('id','=',$id->PRT_FK_Articulos_id)
                            ->update(['FK_ART_Estado_id'=>4]);//disponible
                    }else{
                        Articulo::where('FK_ART_Kit_id','=',$id->PRT_FK_Kits_id)
                            ->update(['FK_ART_Estado_id'=>4]);//disponible
                    }
                }
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Reserva registrada correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function dataListarFuncionarios(Request $request)
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
                ['PRT_FK_Tipo_Solicitud','=',2],
                ['PRT_FK_Estado','!=',3]
                ])->get();//2=prestamos
            $funcionarios =($funcionarios)->groupBy('PRT_Num_Orden');
            $array = array();
            foreach ($funcionarios as $le) {
                array_push($array, $le[0]);
            }
            return DataTables::of($array)
                ->addIndexColumn()
                ->make(true);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
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
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function crearProgramaFuncio(Request $request, $idFuncionario)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            UsuarioAudiovisuales::create([
                'USER_FK_Programa' => $request->get('FK_FUNCIONARIO_Programa'),
                'USER_FK_User' => $idFuncionario
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Programa registrado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function listarElementosSelect(Request $request, $articulos)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            if ($articulos == 1) {
                $tipo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                    $query->where([
                        ['FK_ART_Estado_id', '=', 1],
                        ['FK_ART_Kit_id', '=', 1],
                    ]);
                })->get();

            } else {
                $tipo = Kit::where([
                    ['KIT_FK_Estado_id', '=', 1],
                    ['id', '!=', 1],
                ])->get();
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $tipo
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function crearPrestamoFuncionario(Request $request, $idKit, $idArticulo, $idFuncionario, $tipo)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
            $id = $user->id;
            if ($tipo != 1) {
                $this->consultarKit($idKit);
            } else {
                $idArticuloConsultado = $this->consultarArticulo($idArticulo);
                $idArticulo = $idArticuloConsultado['id'];
            }
            if ($request['PRT_Observacion_Recibe'] == '') {
                Solicitudes::create([
                    'PRT_FK_Articulos_id' => $idArticulo,
                    'PRT_Fecha_Inicio' => '2017-09-12 00:02:04',
                    'PRT_Fecha_Fin' => '2017-09-12 00:02:04',
                    'PRT_FK_Funcionario_id' => $idFuncionario,
                    'PRT_FK_Kits_id' => $idKit,
                    'PRT_Observacion_Entrega' => $request['PRT_Observacion_Entrega'],
                    'PRT_Observacion_Recibe' => '',
                    'PRT_FK_Estado' => 2,
                    'PRT_FK_Tipo_Solicitud' => 2,//prestamo
                    'PRT_FK_Administrador_Entrega_id' => $id,
                    'PRT_FK_Administrador_Recibe_id' => 0
                ]);
            } else {
                Solicitudes::where([
                    ['PRT_FK_Funcionario_id', '=', $idFuncionario],

                ])->update(
                    ['PRT_FK_Estado' => 3],
                    ['PRT_Observacion_Recibe' => $request['PRT_Observacion_Recibe']],
                    ['PRT_FK_Administrador_Recibe_id' => $id]
                );
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Reserva registrada correctamente.'
            );

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function consultarArticulosKit(Request $request,$idKit){

        if($request->ajax() && $request->isMethod('GET')){
            //$kitId = Solicitudes::select('PRT_FK_Kits_id')->where('id','=',$idSolicitud)->get();
            $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo'])->where([
                ['FK_ART_Kit_id','=',$idKit]
            ])->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                json_decode($articulos)

            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    public function consultarArticulosKitAdmin(Request $request,$idSolicitud){

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
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    public function crearPrestamoRepeat(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $infoRepeat = json_decode($request->get('infoPrestamo'));
            $numOrden = (Solicitudes::max('PRT_Num_Orden')) + 1;
            $user = Auth::user();
            $adminId = $user->id;
            foreach ($infoRepeat as $prestamo) {
                $bandera=false;
                $idArticulo = 0;
                if($prestamo->kit == true){
                    $kitSolicitado = $prestamo->tipoArticulosSelect;
                    $idKitConsultado = $this->consultarKit($prestamo->tipoArticulosSelect);
                    if($idKitConsultado != null ){
                        $bandera = true;
                        $idArticulo = 0;
                    }
                }else{
                    $idArticuloConsultado = $this->consultarArticulo($prestamo->tipoArticulosSelect);
                    if($idArticuloConsultado != null){
                        $bandera =true;
                        $idArticulo = $idArticuloConsultado['id'];
                        $kitSolicitado = 1;
                    }
                }
                if($bandera == true){
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
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Prestamo registrado correctamente.'
            );

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function actualizarArticulos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $h = json_decode($request->get('tipo'));
            $this->actualizarEstadosArticulo($h->tipoArticulosSelect, $h->cantidadArticulos);            //$idArticulo = $idArticuloConsultado['id'];
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Reserva registrada correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function actualizarEstadosArticulo($tipo, $cantidad)
    {
        for ($i = 0; $i < (int)$cantidad; $i++) {
            Articulo::where([
                ['FK_ART_Tipo_id', '=', (int)$tipo],
                ['FK_ART_Estado_id', '=', 1]

            ])->update(['FK_ART_Estado_id' => 3]);
        }
    }
    public function consultarArticulo($idTipoArticulo)
    {
        $query = Articulo::where([
            ['FK_ART_Tipo_id', '=', $idTipoArticulo],
            ['FK_ART_Estado_id', '=', 4]

        ])->first();
        /////////////
        /// si el articulo pertenece a un kit , cambia el estado del kit
        /// el kit ya no estara completo para ser reservado
        /// // /////////////
        if ($query['FK_ART_Kit_id'] != 1) {
            Articulo::where([
                ['id', '=', $query['id']],

            ])->update(['FK_ART_Estado_id' => 2]);
            Kit::where([
                ['id', '=', $query['FK_ART_Kit_id']],
            ])->update(['KIT_FK_Estado_id' => 2]);
        } else {
            Articulo::where([
                ['id', '=', $query['id']],
            ])->update(['FK_ART_Estado_id' => 2]);
        }
        return $query;

    }
    public function consultarKit($PRT_FK_Kits_id)
    {
        $query = Kit::where([
            ['id', '=', $PRT_FK_Kits_id],
            ['KIT_FK_Estado_id', '=', 4]

        ])->first();
        if($query != null){
            $query = Kit::where([
                ['id', '=', $PRT_FK_Kits_id],
            ])->update(['KIT_FK_Estado_id' => 2]);
            $query = Articulo::where([
                ['FK_ART_Kit_id', '=', $PRT_FK_Kits_id],
            ])->update(['FK_ART_Estado_id' => 2]);

        }
        return $query;
    }
    /////////////////////////////////////////////////////////
    /// actualizar estado articulos Kits
    /// //////////////////////////////
    public function actualizar($query)
    {
        if (($query[0]['PRT_FK_Kits_id']) != 1) {
            $query = Articulo::where([
                ['FK_ART_Kit_id', '=', $query[0]['PRT_FK_Kits_id']],
            ])->update(['FK_ART_Estado_id' => 1]);

            Kit::where([
                ['id', '=', $query[0]['PRT_FK_Kits_id']],

            ])->update(['KIT_FK_Estado_id' => 1]);
        } else {
            Articulo::where([
                ['id', '=', 1],
            ])->update(['FK_ART_Estado_id' => 1]);
        }

    }
    public function ajaxUniqueIdentificacion(Request $request)
    {
        if (User::where('identity_no', $request->get('id_funcionario'))->exists()) {
            return \Response::json(true);
        } else {
            return \Response::json(false);
        }
    }
}
