<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\Src\TipoArticulo;
use App\Container\Audiovisuals\src\Validaciones;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArticuloController extends Controller
{
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
     */

     //metodos articulos
        /**
         * Funcion que muestra todos los articulos registrados
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexArticulo(Request $request)
        {
            if ($request->isMethod('GET')) {
                return view('audiovisuals.articulo.gestionArticulos');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
        /**
         * Función que consulta los articulos registrados y los envía al datatable correspondiente.
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function dataTableArticulos(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo','consultaEstadoArticulo' ])->get();
                return DataTables::of($articulos)
                    ->removeColumn('created_at')
                    ->removeColumn('updated_at')
                    ->addIndexColumn()
                    ->make(true);
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud.'
            );
        }
        /**
         * Funcion que realaliza la elimincacion del aritulo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response
         */
        public function elimarArticulo(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                Articulo::where('id', '=',$request['id'] )->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El Artículo se ha eliminado correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que realiza la consulta de los kits registrados
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function cargarKits(Request $request){
            if($request->ajax() && $request->isMethod('GET')){
                $kit = Kit::all();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos consultados correctamente.',
                    $kit
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que realiza la consulta de los tipos de articulos registrados
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function cargarTipoArticulosA(Request $request){
            if($request->ajax() && $request->isMethod('GET')){
                $tiposArticulo = TipoArticulo::all();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos consultados correctamente Articulos.',
                    $tiposArticulo
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que realiza el registro de un articulo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function storeArticulos(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                Articulo::create([
                    'FK_ART_Tipo_id' => $request['FK_ART_Tipo_id'],
                    'ART_Descripcion' => $request['ART_Descripcion'],
                    'FK_ART_Kit_id' => $request['FK_ART_Kit_id'],
                    'FK_ART_Estado_id' => 1,//creado
                    'ART_Codigo' => $request['ART_Codigo'],
                ]);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El Articulo se ha registrado correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         *Funcion que realiza la modificacion del articulo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function modificarArticulo(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                $articulo = Articulo::find($request['id']);
                $articulo->fill($request->all());
                $articulo->save();
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
     //metodos tipo de articulos
        /**
         * Funcion que muestra todos los tipos de articulos registrados por medio de una petición ajax.
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View|\App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexTipoArtciuloAjax(Request $request){
            if($request->ajax() && $request->isMethod('GET')) {
                return view('audiovisuals.articulo.contenidoAjax.gestionTipoArticuloAjax');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Función que consulta los tipos de articulos registrados y los envía al datatable correspondiente.
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function dataTableTipoArticulos(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $tipoArticulos = TipoArticulo::withCount('consultarArticulos')->get();
                return DataTables::of($tipoArticulos)
                    ->addColumn('Tiempo', function ($solicitudes) {
                        if ($solicitudes->TPART_Tiempo == 1) {
                            return "Libre";

                        } else {
                            return  "Asignado";
                        }
                    })
                    ->removeColumn('created_at')
                    ->removeColumn('updated_at')
                    ->addIndexColumn()
                    ->make(true);

            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Función que muestra las validaciones por medio de una peticion ajax
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexValidacionesAjax(Request $request){
            if($request->ajax() && $request->isMethod('GET')) {
                $preguntas = Validaciones::select()
                    ->orderBy('id')
                    ->get();
                return view('audiovisuals.articulo.contenidoAjax.tablaValidacionesAjax')
                    ->with('dato',$preguntas);

            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que elimina el tipo de articulo
         *
         * @param Request $request
         * @param $idTipoArticulo
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function tipoArticuloEliminar(Request $request, $idTipoArticulo)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                $user = TipoArticulo::find($idTipoArticulo);
                $user->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El Tipo Articulo se ha eliminado correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que modifica los datos del tipo articulo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response
         */
        public function modificarTipoArt(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                $tipo = TipoArticulo::find($request['id']);
                $tipo->TPART_Nombre = $request['TPART_Nombre'];
                $tipo->TPART_Tiempo = $request['TPART_Tiempo'];
                $tipo->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El Tipo Articulo se ha modificado correctamente.',
                    $tipo
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que consulta en el modelo TIPOARTICULO para validar un unico nombre para tipo articulo
         *
         * @param Request $request
         * @return mixed
         */
        public function ajaxUniqueTipoArt(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                if (TipoArticulo::where('TPART_Nombre', $request->get('TPART_Nombre'))->exists()) {
                    return \Response::json(false);
                } else {
                    return \Response::json(true);
                }
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que registra el tipo de articulo
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function storeTipoArt(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                $tiempo =((int)($request['TPART_Tiempo']));
                TipoArticulo::create([
                    'TPART_Nombre' => $request['TPART_Nombre'],
                    'TPART_Tiempo'=> $tiempo,

                ]);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Tipo de Articulo registrado correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         *  Función que muestra la gestion de articulos por medio de una peticion ajax
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function indexGestionArticuloAjax(Request $request){
            if($request->ajax() && $request->isMethod('GET')) {
                return view('audiovisuals.articulo.contenidoAjax.gestionArticulosAjax');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
     //metodos kits
        /**
         * Funcion que muestra la gestion de kits
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function indexKit(Request $request)  {
            if ($request->isMethod('GET')) {
                return view('audiovisuals.articulo.gestionKits');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que muestra la gestion de creacion de un kit
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function formRepeatKitAjax(Request $request)
        {
            if ($request->isMethod('GET')) {
                return view('audiovisuals.articulo.contenidoAjax.formRepeatKitAjax');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );

        }
        /**
         * Funcion que lista los tipos de articulos registrados
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function cargarTipoArticulos(Request $request){
            if($request->ajax() && $request->isMethod('GET')){
                $tiposArticulo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                    $query->where('FK_ART_Kit_id', '=', 1)->where(function ($query) {
                        $query->where('FK_ART_Estado_id', '=', 1)
                            ->orWhere('FK_ART_Estado_id', '=', 4);
                    });
                })->get();
                $tiposArticulo = $tiposArticulo->toArray();
                $idPrimerTipoArticulo = $tiposArticulo[0]['id'];
                $codigosArticulos = Articulo::where(
                    [
                        ['FK_ART_Tipo_id','=',$idPrimerTipoArticulo ],//codigo primer tipo articulo
                        ['FK_ART_Kit_id','=',1 ],//sin kit
                    ]
                )->where(function ($query){
                    $query->where('FK_ART_Estado_id', '=', 1)
                        ->orWhere('FK_ART_Estado_id', '=', 4);
                })->get();

                array_push($tiposArticulo,$codigosArticulos);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos consultados correctamente Articulos.',
                    $tiposArticulo
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que registra el articulo a un kit existente
         *
         * @param Request $request
         * @param $idArticulo
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function asignarArticuloAlkit(Request $request, $idArticulo, $idKit){
            if ($request->ajax() && $request->isMethod('GET')) {
                $articulo = Articulo::find($idArticulo);
                $articulo->FK_ART_Kit_id = $idKit;
                $articulo->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos cargados correctamenteasdasdasd.'

                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion donde modifica la asigancion de kit al articulo
         *
         * @param Request $request
         * @param $idArticulo
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function removerArticuloKit(Request $request, $idArticulo){
            if ($request->ajax() && $request->isMethod('GET')) {
                $articulo = Articulo::find($idArticulo);
                $articulo->FK_ART_Kit_id = 1;//sin kit
                $articulo->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos cargados correctamenteasdasdasd.'

                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         *Funcion donde registra kit
         *
         * @param Request $request
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function storeKit(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                Kit::create([
                    'KIT_Nombre' => $request['KIT_Nombre'],
                    'KIT_FK_Estado_id' => 1,//creado
                    'KIT_FK_Tiempo' => $request['KIT_FK_Tiempo'],
                    'KIT_Codigo' => $request['KIT_Codigo'],
                ]);
                $idKitCreado = Kit::all()->last()->id;
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El kit se ha registrado correctamente.',
                    $idKitCreado
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion donde valida un unico nombre de Kit
         *
         * @param Request $request
         * @return mixed
         */
        public function ajaxUniqueKit(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                if (Kit::where('KIT_Nombre', $request->get('KIT_Nombre'))->exists()) {
                    return \Response::json(false);
                } else {
                    return \Response::json(true);
                }
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion donde consulta los codigos de un tipo de articulo
         *
         * @param Request $request
         * @param $idTipoArticulo
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function codigoArticuloSelect(Request $request, $idTipoArticulo)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $codigoArticuloss = Articulo::where(
                    [
                        ['FK_ART_Tipo_id','=',$idTipoArticulo ],
                        ['FK_ART_Kit_id','=',1 ],//sin kit
                    ]
                )->where(function ($query){
                    $query->where('FK_ART_Estado_id', '=', 1)
                        ->orWhere('FK_ART_Estado_id', '=', 4);
                })->get();
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $codigoArticuloss
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion donde consulta la descripcion de un articulo
         *
         * @param Request $request
         * @param $codigoArticulo
         * @return \Illuminate\Http\Response| \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function caracteristicaArticulo(Request $request, $codigoArticulo)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $codigoArticulos = Articulo::select('ART_Descripcion')
                    ->where('id','=',$codigoArticulo)->get();
                return AjaxResponse::success(
                    '¡datos consultados !',
                    'correctamente.',
                    $codigoArticulos
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que elimina un kit(sin sus articulos que contenga,sin dejar registro)
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function eliminarKit(Request $request, $idKit)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                Articulo::where('FK_ART_Kit_id', '=',$idKit )->update(['FK_ART_Kit_id' => 1]);
                Kit::where('id', '=',$idKit )->forcedelete();
                return AjaxResponse::success(
                    '¡Kit eliminado!',
                    'Correctamente.'

                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion que elimina un kit (sin articulos , quedara en un registro para reutilizar codigo)
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function eliminarKitSoftdelete(Request $request, $idKit)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                Articulo::where('FK_ART_Kit_id', '=',$idKit )->update(['FK_ART_Kit_id' => 1]);
                Kit::where('id', '=',$idKit )->delete();
                return AjaxResponse::success(
                    '¡Kit eliminado!',
                    'Correctamente.'

                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion donde se modifca el contenido de un kit (agregar,eliminar articulos)
         *
         * @param Request $request
         * @param $idKit
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function articuloskitAjax(Request $request, $idKit){
            if($request->ajax() && $request->isMethod('GET')) {
                $articulos = Articulo::with('consultaTipoArticulo','consultaKitArticulo')
                    ->where('FK_ART_Kit_id','=',$idKit)->get();
                if((count($articulos))!=0){
                    $nombreKit = $articulos[0]['consultaKitArticulo']['KIT_Nombre'];
                }else{
                    $nombreKit = Kit::select('KIT_Nombre')->where('id','=',$idKit)->get();
                    $nombreKit = $nombreKit[0]['consultaKitArticulo']['KIT_Nombre'];
                    $articulos = null;
                }
                return view('audiovisuals.articulo.contenidoAjax.articulosKitAjax',
                    [
                        'articulos'=>$articulos,
                        'nombreKit'=> $nombreKit,
                        'idKit'=>$idKit
                    ]
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Funcion donde modifica el kit
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function kitModificar(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                $kit = Kit::find($request['id']);
                $kit->KIT_Nombre = $request['KIT_Nombre'];
                $kit->KIT_FK_Tiempo = $request['KIT_FK_Tiempo'];
                $kit->KIT_Codigo = $request['KIT_Codigo'];
                $kit->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El kit se ha modificado correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Función que consulta los kits registrados y los envía al datatable correspondiente.
         *
         * @param Request $request
         * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
         */
        public function dataTableKits(Request $request)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
                $kits = Kit::where('id','!=',1)->get();
                return DataTables::of($kits)
                    ->removeColumn('created_at')
                    ->removeColumn('updated_at')
                    ->addIndexColumn()
                    ->make(true);

            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        /**
         * Fucion que muestra la gestion de los kits por mdeio de una peticion ajax
         *
         * @param Request $request
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
         */
        public function indexAjax(Request $request){
            if($request->ajax() && $request->isMethod('GET')) {
                return view('audiovisuals.articulo.contenidoAjax.gestionKitsAjax');
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
}
