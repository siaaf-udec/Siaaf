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
    public function listarDocentes(Request $request, $rol)
    {
       /* if($rol == 'Todos'){
            $empleados = Persona::all();
        }else {
            $empleados = Persona::where('PRSN_Rol', $rol)->get();
        }
        return view('humtalent.empleado.listaEmpleados', compact('empleados'));*/
        if($request->ajax()){
            if($rol == 'Todos') {
                return Datatables::of(Persona::all())
                    ->addIndexColumn()
                    ->make(true);
            }else{
                return Datatables::of(Persona::where('PRSN_Rol', $rol)->get())
                    ->addIndexColumn()
                    ->make(true);
            }
        }else{
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ],412);
        }
    }
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

        return view('humtalent.documentacion.radicarDocumentos', compact('empleados', 'documentos'));
    }
    public function radicarDocumentos(Request $request)
    {
        StatusOfDocument::create([
            //'EDCMT_Fecha'          =>$request['FK_TBL_Persona_Cedula'],
            //'EDCMT_Proceso_Documentacion'  => $request['FK_TBL_Persona_Cedula'],
            'FK_TBL_Persona_Cedula'        => $request['FK_TBL_Persona_Cedula'],
            'FK_Personal_Documento'        => $request['FK_Personal_Documento']
        ]);
        return "La documentación se radico correctamente";//back()->with('success','La documentación se radico correctamente');
    }
}