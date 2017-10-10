<?php

namespace App\Container\Unvinteraction\src\Controllers;


use App\Container\Unvinteraction\src\TBL_Usuarios;
use App\Container\Unvinteraction\src\TBL_Tipo_Usuario;
use App\Container\Unvinteraction\src\TBL_Estado_Usuario;
use App\Container\Unvinteraction\src\TBL_Carrera;
use App\Container\Unvinteraction\src\TBL_Facultad;
use App\Container\Unvinteraction\src\TBL_Documentacion;
use App\Container\Unvinteraction\src\TBL_Convenios;
use App\Container\Unvinteraction\src\TBL_Evaluacion;
use App\Container\Unvinteraction\src\TBL_Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\TBL_Preguntas;
use App\Container\Unvinteraction\src\TBL_Sede;
use App\Container\Unvinteraction\src\TBL_Estado;
use App\Container\Unvinteraction\src\TBL_Empresas_Participantes;
use App\Container\Unvinteraction\src\TBL_Empresa;
use App\Container\Unvinteraction\src\TBL_Participantes;
use App\Container\Unvinteraction\src\TBL_Documentacion_Extra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;

class Controller_Documentos extends Controller
{
  
     private $path='unvinteraction'; 
     public function Subir_Documento_Convenio(Request $request,$id)
    {
       $Ubicacion="unvinteraction/convenios/".$id;
       $files = $request->file('file');
       foreach($files as $file){
            $url = Storage::disk('developer')->putFileAs($Ubicacion, $file, $file->getClientOriginalName());
             
        }
            $Estado = new TBL_Documentacion();
            $Estado->Entidad =$file->getClientOriginalName();  
            $Estado->Ubicacion = $Ubicacion."/".$file->getClientOriginalName() ;
            $Estado->Tipo = 'ninguno' ;
            $Estado->FK_TBL_Convenios= $id;
            $Estado->Descripcion = 'ninguno' ;
            $Estado->save();
       return $request->get('name');       
    }
    
    
     public function Documento_Descarga(Request $request,$id,$idc)
    {
         $Ubicacion="unvinteraction/convenios/".$id;
         $Documento= TBL_Documentacion::select('TBL_Documentacion.Ubicacion')
             ->where('PK_Documentacion',$id)->get();
          foreach($Documento as $row){
                  try{
                    if($exists = Storage::disk('developer')->exists($row->Ubicacion)){
                        $Contents = Storage::disk('developer')->get($row->Ubicacion);
                        return  response()->download(storage_path()."/app/public/developer/".$row->Ubicacion,"documento.jpg");
                        return  "listo";
                     }else{
                         return "error2=".$row->Ubicacion;
                     }
                }catch(Exception $e){
                       return "error1";
                }     
            }
        
    }
    public function Mis_Documentos()
    {
         return view($this->path.'.Listar_Mis_Documentos');
    }
    public function Listar_Mis_Documentos(Request $request)
    {
        
        $documento = TBL_Documentacion_Extra::select('TBL_Documentacion_Extra.PK_Documentacion_Extra','TBL_Documentacion_Extra.Descripcion','TBL_Documentacion_Extra.Ubicacion','TBL_Documentacion_Extra.Entidad')
             ->where('FK_TBL_Usuarios',$request->user()->identity_no)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
            
    }
    public function Subir_Documento_Usuario(Request $request)
    {
        $Ubicacion="unvinteraction/usuario/".$request->user()->identity_no;
        $files = $request->file('file');
       
        foreach($files as $file){
            $url = Storage::disk('developer')->putFileAs($Ubicacion, $file, $file->getClientOriginalName());
        }
       
     try{
            $Estado = new TBL_Documentacion_Extra();
            $Estado->Entidad =$file->getClientOriginalName();  
            $Estado->Ubicacion = $Ubicacion ;
            $Estado->FK_TBL_Usuarios=$request->user()->identity_no ;
            $Estado->Descripcion = 'NINGUNA';
            $Estado->save();
            return  "listo";
            
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
       
       return $request->get('name');
    }
     public function Documento_Descarga_Usuario(Request $request,$id)
    {
         $Ubicacion="unvinteraction\usuario";
         $Documento=
            TBL_Documentacion_Extra::select('TBL_Documentacion_Extra.PK_Documentacion_Extra','TBL_Documentacion_Extra.Descripcion','TBL_Documentacion_Extra.Ubicacion','TBL_Documentacion_Extra.Entidad')
             ->where('FK_TBL_Usuarios',$request->user()->identity_no)
                ->where('PK_Documentacion_Extra',$id)->get();
          foreach($Documento as $row){
                  try{
                    if($exists = Storage::disk('developer')->exists($Ubicacion.$request->user()->identity_no."/".$request->user()->identity_no.$row->Entidad.$row->Descripcion.".pdf")){
                        $Contents = Storage::disk('developer')->get($Ubicacion.$request->user()->identity_no."/".$request->user()->identity_no.$row->Entidad.$row->Descripcion.".pdf");
                        return  response()->download(storage_path()."/app/public/developer/".$Ubicacion.$request->user()->identity_no."/".$request->user()->identity_no.$row->Entidad.$row->Descripcion.".pdf","Documento.pdf");
                        return  "listo";
                     }else{
                         return "error2=".$Ubicacion.$request->user()->identity_no."/".$request->user()->identity_no.$row->Entidad.$row->Descripcion.".jpg";
                     }
                }catch(Exception $e){
                       return "error1";
                }     
            }
        
    }
}
