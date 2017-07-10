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
    public function buscarByCedula(Request $request)
    {
        $id = $request['PK_PRSN_Cedula'];
        $empleados = Persona::where('PK_PRSN_Cedula', $id)->get();
        return view('humtalent.empleado.listaEmpleados', compact('empleados'));
    }
    public function listarDocsRad(Request $request){
        $id  = $request['PK_PRSN_Cedula'];
        $empleados = Persona::where('PK_PRSN_Cedula',$id)->get();
        $documentos =  DocumentacionPersona::all();
        $docs=[];
        foreach ($documentos as $documento){
            $docs=$docs+[$documento->PK_DCMTP_Id_Documento => $documento->DCMTP_Nombre_Documento];
        }
        $selects=StatusOfDocument::where('FK_TBL_Persona_Cedula',$id)->get(['FK_Personal_Documento']);
        $seleccion=[];
        foreach ($selects as $select){
            $seleccion=array_merge($seleccion, [$select->FK_Personal_Documento]);
        }
       // return $seleccion;
        return view('humtalent.documentacion.radicarDocumentos', compact('empleados', 'docs', 'seleccion'));
    }
    public function radicarDocumentos(Request $request)
    {
        $documento=$request['FK_Personal_Documento'];
        $radicados=StatusOfDocument::where('FK_TBL_Persona_Cedula',$request['FK_TBL_Persona_Cedula'])->get(['FK_Personal_Documento']);
        $cant=count($documento);

        for($i=0; $i<$cant;$i++){
            StatusOfDocument::create([
                //'EDCMT_Fecha'          =>$request['FK_TBL_Persona_Cedula'],
                //'EDCMT_Proceso_Documentacion'  => $request['FK_TBL_Persona_Cedula'],
                'FK_TBL_Persona_Cedula'        => $request['FK_TBL_Persona_Cedula'],
                'FK_Personal_Documento'        => $documento[$i]
            ]);
        }
        return "La documentación se radico correctamente";//back()->with('success','La documentación se radico correctamente');
    }
}