<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Asistencias';

    protected $primaryKey = 'PK_ASIS_Id_Registro';

    protected $fillable = [
        'ASIS_Id_Identificacion',
        'ASIS_Espacio_Academico',
        'ASIS_Espacio',
        'ASIS_Tipo_Practica',
        'ASIS_Id_Carrera',
        'ASIS_Nombre_Materia',
        'ASIS_Cant_Estudiantes'
    ];

    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions(){
        return $this->hasMany(Induction::class);
    }
    public function Permissions(){
        return $this->hasMany(Permission::class);
    }
    // 
}