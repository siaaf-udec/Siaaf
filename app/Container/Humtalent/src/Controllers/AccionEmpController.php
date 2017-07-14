<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 24/06/2017
 * Time: 6:18 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\DocumentacionPersona;
use App\Container\Humtalent\src\StatusOfDocument;
use Yajra\Datatables\Datatables;

class accionEmpController extends Controller
{
    public function listarDocsRad(Request $request){ //funcion que se encarga de listar los documentos registrados y que debern ser entregados por los empleados
        $id  = $request['PK_PRSN_Cedula'];  //se recibe como parametro el numero de cedula del empleado a quien se le van a radicar los documentos
        $empleados = Persona::where('PK_PRSN_Cedula',$id)->get();//se realiza la consulta del empleado correspondiente
        $documentos =  DocumentacionPersona::all();//se realiza la consulta de los documentos requeridos que esten registrados
        $docs=[];//array para almacenar con indices numericos los documentos consultados
        foreach ($documentos as $documento){
            $docs=$docs+[$documento->PK_DCMTP_Id_Documento => $documento->DCMTP_Nombre_Documento];//se realiza la conversion del array con clave a array con indices numéricos
        }
        $selects=StatusOfDocument::where('FK_TBL_Persona_Cedula',$id)->get(['FK_Personal_Documento']); //se realiza la consulta a la tabla estado documentación para saber que documentos ya han sido radicados por el empleado
        $seleccion=[];//array para almacenar con indices numericos los documentos consultados
        foreach ($selects as $select){
            $seleccion=array_merge($seleccion, [$select->FK_Personal_Documento]);//se realiza la conversion del array con clave a array con indices numéricos
        }
       // return $seleccion;
        return view('humtalent.documentacion.radicarDocumentos', compact('empleados', 'docs', 'seleccion'));//y se muestran todas las consultas en el formuario de radicacion
    }
    public function radicarDocumentos(Request $request)//funcion que almacena las radicación de los documentos
    {
        $documento=$request['FK_Personal_Documento'];   //se toman los documentos a radicar.
        $radicados= StatusOfDocument::where('FK_TBL_Persona_Cedula',$request['FK_TBL_Persona_Cedula'])->get(['FK_Personal_Documento']); //se realiza una consulta de los documentos ya radicados para el empleado
        $docsRad=[];
        foreach ($radicados as $radicado){
            $docsRad=array_merge($docsRad, [$radicado->FK_Personal_Documento]); //se realiza la conversion del array con clave a array con indices numéricos
        }
        if( !empty($docsRad) ){  //en caso de que ya hayan radicado algunos documentos con anterioridad
            for ($j = 0; $j < count($documento); $j++) {//se recorren los documentos a radicar
                $contador = 0;
                for ($k = 0; $k < count($docsRad); $k++) {//se recorren los documentos ya radicados
                    if ($documento[$j] != $docsRad[$k]) {//se comparan los documentos a radicar con los ya radicados
                        $contador = $contador + 1;
                    }
                }
                if ($contador == count($docsRad)) {//si la variable contador es igual al tamaño del vector que contiene los documentos ya radicados quiere decir que hay un documento nuevo
                    StatusOfDocument::create([ //por ende se crea un nuevo registro en la  tabla estadodocumentacion relacionando el documento con el epmpleado
                        'EDCMT_Fecha' => $request['EDCMT_Fecha'],
                        //'EDCMT_Proceso_Documentacion'  => $request['FK_TBL_Persona_Cedula'],
                        'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
                        'FK_Personal_Documento' => $documento[$j]
                    ]);
                }
            }//una vez se hayan registrado los documentos nuevos del empelado que no esten radicados
            for ($j = 0; $j < count($docsRad); $j++) {//se recorre los documentos radicados
                $contador = 0;
                for ($k = 0; $k < count($documento); $k++) {//se recorre los docuimentos enviados
                    if ($documento[$k] != $docsRad[$j]) { //se realiza la comparacion con la finalidad de ver si habia un documento radicado y que el funcionario ahopra desea eliminar
                        $contador = $contador + 1;
                    }
                }
                if ($contador == count($documento)) { //cuando la variable contador sea igual al tamaño del vector que contiene los documentos enviados a radicar
                    StatusOfDocument::where('FK_TBL_Persona_Cedula',$request['FK_TBL_Persona_Cedula']) //quiere decir que se ha deseleccionado uno de los documentos ya radicados
                                        ->where('FK_Personal_Documento',$docsRad[$j])->delete();//por ende se realiza la respectiva eliminación
                }
            }
        }else{//en caso de que no se hayan radicado algunos documentos con anterioridad para el empleado
            for ($i = 0; $i < count($documento); $i++) {
                StatusOfDocument::create([ //se realiza un registro completo de los documentos enviados para radicar
                    'EDCMT_Fecha' => $request['EDCMT_Fecha'],
                    //'EDCMT_Proceso_Documentacion'  => $request['FK_TBL_Persona_Cedula'],
                    'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
                    'FK_Personal_Documento' => $documento[$i]
                ]);
            }
        }
       /* $notification=array(
            'message'=>'La documentación se radico correctamente',
            'alert-type'=>'success'
        );
        return back()->with($notification);*/
       return "La documentación se radico correctamente";
    }
}