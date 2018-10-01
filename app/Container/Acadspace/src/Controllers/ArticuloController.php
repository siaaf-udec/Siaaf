<?php

namespace App\Container\Acadspace\src\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Articulo;
use App\Container\Acadspace\src\Categoria;
use App\Container\Acadspace\src\Procedencia;
use App\Container\Acadspace\src\Imagen;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;



class ArticuloController extends Controller
{
    /**
     * Funcion para mostrar la vista elementos o articulos
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */

    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
                $cate=new categoria();
                $categoria=$cate->pluck('CAT_Nombre','PK_CAT_Id_Categoria');
                $pro= new Procedencia();
                $procedencia= $pro->pluck('PRO_Nombre','PK_PRO_Id_Procedencia');
                //Muestra vista elementos
                return view('acadspace.Articulo.formularioArticulo',
                [
                   'categoria'=>$categoria->toArray(),
                   'procedencia'=>$procedencia->toArray()
                ]);
            }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /**
      * Funcion registrar articulo retorna un mensaje Ajax
      * @param Request $request
      * @return \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function regisArticulo(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $archivo = $request->file('Imagen');
            $obtArticulo = new Articulo();
            $obtArticulo->ART_Codigo = $request['ART_Codigo'];
            $obtArticulo->ART_Descripcion = $request['ART_Descripcion'];
            $obtArticulo->ART_Fecha_Registro = Carbon::now();
            $obtArticulo->FK_ART_Id_Categoria = $request['FK_ART_Id_Categoria'];
            $obtArticulo->FK_ART_Id_Procedencia = $request['FK_ART_Id_Procedencia'];
            $obtArticulo->save();
            if($archivo){
                $nombre = 'Imagen del articulo con codigo ' . $obtArticulo->ART_Codigo;
                $url = Storage::disk('developer')->putFile('acadspace/articulos',$archivo);
                $urlNew = Storage::url('developer/'. $url);
                $guardarImagen = new Imagen();
                $guardarImagen->IMA_Ruta = $urlNew;
                $guardarImagen->IMA_Nombre = $nombre;
                $guardarImagen->FK_IMA_Id_Articulo = $obtArticulo->PK_ART_Id_Articulo;
                $guardarImagen->save();
            }
            return AjaxResponse::success(
              '¡Registro exitoso!',
              'Articulo agregada correctamente.'
            );
        }return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * funcion para cargar articulos ya registrados
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        //Recibe peticion Ajax

        if ($request->ajax() && $request->isMethod('GET')) {
            //Relaciona la tabla articulos con, categorias y prodecencias
            
            $articulos = Articulo::select('PK_ART_Id_Articulo', 'ART_Codigo',
                'ART_Descripcion', 'FK_ART_Id_Categoria','FK_ART_Id_Procedencia','FK_ART_Id_Hojavida')
            ->with(['categoria' => function ($query) {
                return $query->select('PK_CAT_Id_Categoria',
                    'CAT_Nombre');
            }])
            ->with(['procedencia' => function ($query) {
                return $query->select('PK_PRO_Id_Procedencia',
                    'PRO_Nombre');
            }])
            ->get();//Trae todos los articulos



            return DataTables::of($articulos)
            ->addColumn('hojavida',function($articulos) {
                if ($articulos->FK_ART_Id_Hojavida==NULL) {
                    return "<span class='label label-sm label-warning'>" . 'No corresponde' . "</span>";
                } else{
                    return "<span class='label label-sm label-success'>" . 'Asignada' . "</span>";
                }
            })
            ->addColumn('imagen',function($articulos){ 
                $infoUsuario = Imagen::select('IMA_Ruta')->where('FK_IMA_Id_Articulo',$articulos->PK_ART_Id_Articulo )->get();
                if($infoUsuario){
                    return $infoUsuario[0]->IMA_Ruta;
                }else{
                    return '<span> LOSER </span>';
                }
            })
                //Elimina columnas no necesarias
                ->rawColumns(['hojavida'])
                ->removeColumn('FK_ART_Id_Categoria')
                ->removeColumn('FK_ART_Id_Procedencia')
                ->removeColumn('FK_ART_Id_Hojavida')
                ->removeColumn('updated_at')
                ->removeColumn('created_at')
                ->removeColumn('fecha_registro')
                ->addIndexColumn()
                ->make(true);//Retorna tabla creada
            /*$articulos = Articulo::select('pk_id_articulo', 'codigo_articulo',
                'descripcion_articulo', 'fk_id_categoria','fk_id_procedencia','fk_id_hojavida')
                ->with(['categoria' => function ($query) {
                    return $query->select('pk_id_categoria',
                        'nombre_categoria');
                }])
                ->with(['procedencia' => function ($query) {
                    return $query->select('pk_id_procedencia',
                        'tipo_procedencia');
                }])
                ->get();
                return DataTables::of($articulos)
                ->addColumn('hojavida',function($articulos) {
                    if ($articulos->fk_id_hojavida->NULL) {
                        return "<span class='label label-sm label-warning'>" . 'Indefinida' . "</span>";
                    } else{
                        return "<span class='label label-sm label-default'>" . 'fk_id_hojavida' . "</span>";
                    }
                })
                ->rawColumns(['hojavida'])
                ->removeColumn('fk_id_hojavida')
                ->removeColumn('fk_id_categoria')
                ->removeColumn('fk_id_procedencia')
                ->addIndexColumn()
                ->make(true);*/

        }
        //Envia notificacion de no recibir peticion ajax
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }
        /**
     * Muestra el perfil de un usuario especifico.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function verImagen(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $infoUsuario = Imagen::select('IMA_Ruta')->where('FK_IMA_Id_Articulo', $id)->get();
            return $infoUsuario->IMA_Ruta;
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $aulas = Articulo::find($id);
            $aulas->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Incidente eliminado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

}
