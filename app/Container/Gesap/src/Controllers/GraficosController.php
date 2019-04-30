<?php

namespace App\Container\Gesap\src\Controllers;


use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;

use Illuminate\Support\Facades\Storage;

use Exception;
use Validator;
use Yajra\DataTables\DataTables;


use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\Crypt;

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Solicitud;
use App\Container\Gesap\src\Actividad;

use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Gesap\src\Fechas;
use App\Container\Gesap\src\Jurados;

use App\Container\Gesap\src\RolesUsuario;
use App\Container\Gesap\src\Desarrolladores;
use App\Container\Gesap\src\Estados;
use App\Container\Gesap\src\Mctr008;
use App\Container\Users\src\User;
use App\Container\Gesap\src\EstadoAnteproyecto;
use App\Container\Users\src\UsersUdec;


use Illuminate\Support\Facades\Auth;

use App\Container\Gesap\src\Mail\EmailGesap;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

use App\Container\Users\src\Controllers\UsersUdecController;


class GraficosController extends Controller
{

    private $path = 'gesap.Graficos.';
    //funcion Que retorna los datos a la vista de graficos para graficar los datos de anteproyecto de grado //
    public function Graficos(Request $request)
    {
            
        $date = Carbon::now();
        $dateinicial = $date->format('Y-m-d');       
        $datepost = $date->subYear();
        $datepostf= $datepost->format('Y-m-d');
        $aprobados = 0;
        $reprobados = 0;
        $aplazados = 0;
        $aprobados2years = 0;
        $reprobados2years = 0;
        $aplazados2years = 0;
        $concatenado=[];
        $concatenado2=[];
        $concatenado3=[];
        $ig2=0;
        $ig3=0;
        $collection = collect([]);
        $datepost2 = $date->subYear(1);
        $datepostf2 = $datepost2->format('Y-m-d');
        
        $anteproyectos = Anteproyecto::whereBetween('NPRY_FCH_Radicacion',[$datepostf,$dateinicial])->get();
        foreach($anteproyectos as $anteproyecto){
            if($anteproyecto->relacionEstado->EST_Estado == "APROBADO"){
                $aprobados = $aprobados +1;
            }
            if($anteproyecto->relacionEstado->EST_Estado == "REPROBADO"){
                $reprobados = $reprobados +1;
            }
            if($anteproyecto->relacionEstado->EST_Estado == "APLAZADO"){
                $aplazados = $aplazados +1;
            }
        }
        $anteproyectos2years = Anteproyecto::whereBetween('NPRY_FCH_Radicacion',[$datepostf2,$datepostf])->get();
        foreach($anteproyectos2years as $anteproyecto2years){
            if($anteproyecto2years->relacionEstado->EST_Estado == "APROBADO"){
                $aprobados2years = $aprobados2years +1;
            }
            if($anteproyecto2years->relacionEstado->EST_Estado == "REPROBADO"){
                $reprobados2years = $reprobados2years +1;
            }
            if($anteproyecto2years->relacionEstado->EST_Estado == "APLAZADO"){
                $aplazados2years = $aplazados2years +1;
            }
        }

        $usuariosg2 = Usuarios::where('FK_User_IdRol',2)->get();
        foreach($usuariosg2 as $usuariog2){
            $anteproyectosg2 = Anteproyecto::where('FK_NPRY_Pre_Director',$usuariog2->PK_User_Codigo)->get();
            if($anteproyectosg2 ->IsNotEmpty()){
                $collection2 = collect([]);
                $collection2 ->put('Docente',$usuariog2->User_Nombre1." ".$usuariog2->User_Apellido1);
                $NAnteproyectos = 0;
                foreach($anteproyectosg2 as $anteproyectog2){
                    if($anteproyectog2 -> NPRY_Ante_Estado == 1){
                        $NAnteproyectos = $NAnteproyectos + 1;
                    }
                }
                $collection2 ->put('NAnteproyectos',$NAnteproyectos);
                $concatenado2[$ig2]= $collection2;
                $ig2 = $ig2+1;
            }
            
        }
        foreach($usuariosg2 as $usuariog2){
            $jurados = Jurados::where('FK_User_Codigo',$usuariog2->PK_User_Codigo)->get();
            if($jurados ->IsNotEmpty()){
                $collection3 = collect([]);
                $collection3 ->put('DocenteJ',$usuariog2->User_Nombre1." ".$usuariog2->User_Apellido1);
                $Njurado = 0;
                foreach($jurados as $jurado){
                    if($jurado->relacionAnteproyecto->NPRY_Ante_Estado  == 1){
                        $Njurado = $Njurado + 1;
                    }
                }
                $collection3 ->put('NJurados',$Njurado);
                $concatenado3[$ig3]= $collection3;
                $ig3 = $ig3+1;
            }
            
        }


        $collection->put('Aprobados',$aprobados);
        $collection->put('Reprobados',$reprobados);
        $collection->put('Aplazados',$aplazados);
        $collection->put('Aprobados2years',$aprobados2years);
        $collection->put('Reprobados2years',$reprobados2years);
        $collection->put('Aplazados2years',$aplazados2years);
        $collection->put('Año2years',$datepostf2." - ".$datepostf);
        $collection->put('Año',$datepostf." - ".$dateinicial);

        $concatenado[0]= $collection;
        
        return view($this->path .'Graficos',
        [
            'datos'=>$concatenado,
            'datos2'=>$concatenado2,
            'datos3'=>$concatenado3,
        ]);
           
        
    }
    //funcion que carga los datos para las graficas de proyectos
    public function GraficosP(Request $request)
    {
            
        $date = Carbon::now();
        $dateinicial = $date->format('Y-m-d');       
        $datepost = $date->subYear();
        $datepostf= $datepost->format('Y-m-d');
        $aprobados = 0;
        $reprobados = 0;
        $aplazados = 0;
        $aprobados2years = 0;
        $reprobados2years = 0;
        $aplazados2years = 0;
        $concatenado=[];
        $concatenado2=[];
        $concatenado3=[];
        $ig2=0;
        $ig3=0;
        $collection = collect([]);
        $datepost2 = $date->subYear(1);
        $datepostf2 = $datepost2->format('Y-m-d');
        
        $proyectos = Proyecto::whereBetween('PYT_Fecha_Radicacion',[$datepostf,$dateinicial])->get();
        foreach($proyectos as $proyecto){
            if($proyecto->relacionEstado->EST_Estado == "APROBADO"){
                $aprobados = $aprobados +1;
            }
            if($proyecto->relacionEstado->EST_Estado == "REPROBADO"){
                $reprobados = $reprobados +1;
            }
            if($proyecto->relacionEstado->EST_Estado == "APLAZADO"){
                $aplazados = $aplazados +1;
            }
        }
        $proyectos2years = Proyecto::whereBetween('PYT_Fecha_Radicacion',[$datepostf2,$datepostf])->get();
        foreach($proyectos2years as $proyecto2years){
            if($proyecto2years->relacionEstado->EST_Estado == "APROBADO"){
                $aprobados2years = $aprobados2years +1;
            }
            if($proyecto2years->relacionEstado->EST_Estado == "REPROBADO"){
                $reprobados2years = $reprobados2years +1;
            }
            if($proyecto2years->relacionEstado->EST_Estado == "APLAZADO"){
                $aplazados2years = $aplazados2years +1;
            }
        }

        $usuariosg2 = Usuarios::where('FK_User_IdRol',2)->get();
        foreach($usuariosg2 as $usuariog2){
            $proyectosg2 = Proyecto::where('FK_NPRY_Director',$usuariog2->PK_User_Codigo)->get();
            if($proyectosg2 ->IsNotEmpty()){
                $collection2 = collect([]);
                $collection2 ->put('Docente',$usuariog2->User_Nombre1." ".$usuariog2->User_Apellido1);
                $Nproyectos = 0;
                foreach($proyectosg2 as $proyectog2){
                    if($proyectog2 -> NPRY_Pro_Estado == 1){
                        $Nproyectos = $Nproyectos + 1;
                    }
                }
                $collection2 ->put('NAnteproyectos',$Nproyectos);
                $concatenado2[$ig2]= $collection2;
                $ig2 = $ig2+1;
            }
            
        }
        foreach($usuariosg2 as $usuariog2){
            $jurados = Jurados::where('FK_User_Codigo',$usuariog2->PK_User_Codigo)->get();
            if($jurados ->IsNotEmpty()){
                $collection3 = collect([]);
                $collection3 ->put('DocenteJ',$usuariog2->User_Nombre1." ".$usuariog2->User_Apellido1);
                $Njurado = 0;
                foreach($jurados as $jurado){
                    if($jurado->relacionAnteproyecto->relacionEstado->EST_Estado == "APROBADO"){
                        if($jurado->relacionAnteproyecto->NPRY_Ante_Estado  == 1){
                            $Njurado = $Njurado + 1;
                        }    
                    }
                    
                }
                $collection3 ->put('NJurados',$Njurado);
                $concatenado3[$ig3]= $collection3;
                $ig3 = $ig3+1;
            }
            
        }
        $collection->put('Aprobados',$aprobados);
        $collection->put('Reprobados',$reprobados);
        $collection->put('Aplazados',$aplazados);
        $collection->put('Aprobados2years',$aprobados2years);
        $collection->put('Reprobados2years',$reprobados2years);
        $collection->put('Aplazados2years',$aplazados2years);
        $collection->put('Año2years',$datepostf2." - ".$datepostf);
        $collection->put('Año',$datepostf." - ".$dateinicial);

        $concatenado[0]= $collection;
        
        return view($this->path .'GraficosP',
        [
            'datos'=>$concatenado,
            'datos2'=>$concatenado2,
            'datos3'=>$concatenado3,
        ]);
           
        
    }
    

}