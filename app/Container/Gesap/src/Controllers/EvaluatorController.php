<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src;

class EvaluatorController extends Controller
{
    private $path='gesap';
    protected $connection = 'gesap';
    public function index()
    {
        return view($this->path.'.Evaluador.Observaciones');
    }

        public function director(){
        return view($this->path.'.Evaluador.DirectorList');
    }
    public function jurado(){
        return view($this->path.'.Evaluador.JuradoList');
    }
    
   public function ListDirector(){
       
       $anteproyectos = DB::select('SELECT *, 
IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director"),"NO ASIGNADO")AS Director, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director")AS DirectorCedula, 

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1"),"NO ASIGNADO")AS Jurado1, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1")AS Jurado1Cedula ,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2"),"NO ASIGNADO")AS Jurado2, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2")AS Jurado2Cedula,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1"),"NO ASIGNADO")AS estudiante1, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1")AS estudiante1Cedula,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2"),"NO ASIGNADO") AS estudiante2, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2")AS estudiante2Cedula

from TBL_Anteproyecto a,TBL_Radicacion r,tbl_encargados ee where r.FK_TBL_Anteproyecto_id=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`="987654321" AND ee.`FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND `NCRD_Cargo`="Director"');
       
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
   }
    
   public function ListJurado(){
       
       $anteproyectos = DB::select('SELECT *, 
IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director"),"NO ASIGNADO")AS Director, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director")AS DirectorCedula, 

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1"),"NO ASIGNADO")AS Jurado1, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1")AS Jurado1Cedula ,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2"),"NO ASIGNADO")AS Jurado2, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2")AS Jurado2Cedula,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1"),"NO ASIGNADO")AS estudiante1, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1")AS estudiante1Cedula,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2"),"NO ASIGNADO") AS estudiante2, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2")AS estudiante2Cedula

from TBL_Anteproyecto a,TBL_Radicacion r,tbl_encargados ee where r.FK_TBL_Anteproyecto_id=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`="1234509876" AND ee.`FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND (`NCRD_Cargo`="Jurado 1" OR `NCRD_Cargo`="Jurado 2") GROUP BY a.PK_NPRY_idMinr008,NPRY_Titulo,NPRY_Keywords,NPRY_Duracion,NPRY_FechaR,NPRY_FechaL,NPRY_Estado,a.created_at,a.updated_at,r.PK_RDCN_idRadicacion,r.RDCN_Min,r.RDCN_Requerimientos,r.FK_TBL_Anteproyecto_id,r.created_at,r.updated_at,ee.PK_NPRY_idCargo,ee.FK_TBL_Anteproyecto_id,ee.FK_TBL_Usuarios_id,ee.NCRD_Cargo,ee.created_at,ee.updated_at');
       
    return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
   }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
