<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\src\Articulo;
use App\Container\Audiovisuals\src\Estado;
use App\Container\Audiovisuals\src\Kit;
use App\Container\Audiovisuals\Src\TipoArticulo;
use App\Container\Audiovisuals\src\Validaciones;
use App\Container\Overall\Src\Facades\AjaxResponse;

use App\Container\Users\Src\City;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    ///////////////////////////////////////////////////////
    /// gestion Kit
    public function indexKit()  {
        return view('audiovisuals.articulo.gestionKits');
    }
    public function formRepeatKitAjax()
    {
        return view('audiovisuals.articulo.contenidoAjax.formRepeatKitAjax');
    }
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function ajaxUniqueKit(Request $request)
    {
        if (Kit::where('KIT_Nombre', $request->get('KIT_Nombre'))->exists()) {
            return \Response::json(false);
        } else {
            return \Response::json(true);
        }
    }
    public function cargarTipoArticulos(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            /*$tiposArticulo = TipoArticulo::whereHas('consultarArticulos', function ($query) {
                $query->where([
                    ['FK_ART_Kit_id', '=', 1],
                    ['FK_ART_Estado_id', '=', 4]
                ]);
            })->get();*/
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
            /*
            $codigosArticulos = Articulo::where(
                [
                    ['FK_ART_Tipo_id','=',$idPrimerTipoArticulo ],//codigo primer tipo articulo
                    ['FK_ART_Estado_id','=',4 ],//disponible
                    ['FK_ART_Kit_id','=',1 ],//sin kit
                ]
            )->get();*/
            array_push($tiposArticulo,$codigosArticulos);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente Articulos.',
                $tiposArticulo
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function codigoArticuloSelect(Request $request,$idTipoArticulo)
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function asignarArticuloAlkit(Request $request,$idArticulo,$idKit){
        if ($request->ajax() && $request->isMethod('GET')) {
            $articulo = Articulo::find($idArticulo);
            $articulo->FK_ART_Kit_id = $idKit;
            $articulo->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamenteasdasdasd.'

            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    public function removerArticuloKit(Request $request,$idArticulo){
        if ($request->ajax() && $request->isMethod('GET')) {
            $articulo = Articulo::find($idArticulo);
            $articulo->FK_ART_Kit_id = 1;//sin kit
            $articulo->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamenteasdasdasd.'

            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    public function dataTableKits(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $kits = Kit::where('id','!=',1)->get();
            return DataTables::of($kits)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function eliminarKit(Request $request, $idKit)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            Articulo::where('FK_ART_Kit_id', '=',$idKit )->update(['FK_ART_Kit_id' => 1]);
            Kit::where('id', '=',$idKit )->forcedelete();
            return AjaxResponse::success(
                '¡Kit eliminado!',
                'Correctamente.'

            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function eliminarKitSoftdelete(Request $request, $idKit)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            Articulo::where('FK_ART_Kit_id', '=',$idKit )->update(['FK_ART_Kit_id' => 1]);
            Kit::where('id', '=',$idKit )->delete();
            return AjaxResponse::success(
                '¡Kit eliminado!',
                'Correctamente.'

            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function indexAjax(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('audiovisuals.articulo.contenidoAjax.gestionKitsAjax');
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function articuloskitAjax(Request $request,$idKit){
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

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    ////////////////////////////////////////////////////////////////////7
    /// gestion Articulos
    ///
    public function indexArticulo()
    {
        return view('audiovisuals.articulo.gestionArticulos');
    }
    public function dataTableArticulos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo','consultaEstadoArticulo' ])->get();
            return DataTables::of($articulos)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function cargarKits(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $kit = Kit::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $kit
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function cargarTipoArticulosA(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $tiposArticulo = TipoArticulo::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente Articulos.',
                $tiposArticulo
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
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
    public function elimarArticulo(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
           // if($request['softdelete']){
                //Articulo::where('id', '=',$request['id'] )->forcedelete();

            //}else{
                Articulo::where('id', '=',$request['id'] )->delete();
           // }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'El Artículo se ha eliminado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    ///////////////////////////////////////
    ///GESTION TIPO ARTICULO
    public function indexTipoArtciuloAjax(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('audiovisuals.articulo.contenidoAjax.gestionTipoArticuloAjax');
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function dataTableTipoArticulos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tipoArticulos = TipoArticulo::withCount('consultarArticulos')->get();
            return DataTables::of($tipoArticulos)
                ->addColumn('Acciones', function ($solicitudes) {
                    if ($solicitudes->consultar_articulos_count >= 1) {
                        return "<a class='btn btn-simple btn-warning btn-icon edit'><i class=\"icon-pencil\"></i></a>";

                    } else {
                        return  '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>
                            <a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>';
                    }
                })
                ->addColumn('Tiempo', function ($solicitudes) {
                    if ($solicitudes->TPART_Tiempo == 1) {
                        return "Libre";

                    } else {
                        return  "Asignado";
                    }
                })
                ->rawColumns(['Acciones'])
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function ajaxUniqueTipoArt(Request $request)
    {
        if (TipoArticulo::where('TPART_Nombre', $request->get('TPART_Nombre'))->exists()) {
            return \Response::json(false);
        } else {
            return \Response::json(true);
        }
    }
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
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function tipoArticuloEliminar(Request $request,$idTipoArticulo)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = TipoArticulo::find($idTipoArticulo);
            $user->delete();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'El Tipo Articulo se ha eliminado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function indexGestionArticuloAjax(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('audiovisuals.articulo.contenidoAjax.gestionArticulosAjax');
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function indexValidacionesAjax(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            $preguntas = Validaciones::select()
                ->orderBy('id')
                ->get();
            return view('audiovisuals.articulo.contenidoAjax.tablaValidacionesAjax')
                ->with('dato',$preguntas);

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }



    /*

	public function storeKit(Request $request)
	{
		if ($request->ajax() && $request->isMethod('POST')) {
			Kit::create([
				'KIT_Nombre' => $request['KIT_Nombre'],
				'KIT_FK_Estado_id' => 4,
                'KIT_FK_Tiempo' => $request['KIT_FK_Tiempo']
			]);
			return AjaxResponse::success(
				'¡Bien hecho!',
				'El kit se ha registrado correctamente.'
			);
		} else {
			return AjaxResponse::fail(
				'¡Lo sentimos!',
				'No se pudo completar tu solicitud.'
			);
		}
	}

    /**
     * Presenta el formulario con los datos para editar el regitro de un articulo.
     *
     * @param  \Illuminate\Http\Request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    /*
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $articulos = Articulo::with(['consultaTipoArticulo','consultaKitArticulo','consultaEstadoArticulo' ])
                ->where('id','=',$id)->get();


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

	public function ajaxUniqueKit(Request $request)
	{
		if (Kit::where('KIT_Nombre', $request->get('KIT_Nombre'))->exists()) {
			return \Response::json(false);
		} else {
			return \Response::json(true);
		}
	}

    /**
     * Se realiza la actualización de los Articulos.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    /*
    public function update(Request $request)
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

    public function cargarEstadoArticulos(Request $request){
        if($request->ajax() && $request->isMethod('GET')){
            $estadosArticulo = Estado::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente Articulos.',
                $estadosArticulo
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
*/
}
