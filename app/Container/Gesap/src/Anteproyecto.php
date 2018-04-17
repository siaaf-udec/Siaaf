<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Anteproyecto extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'gesap';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Anteproyecto';

    /**
     * Nombre de columna primary_key de tabla .
     *
     * @var string
     */
    protected $primaryKey = 'PK_NPRY_IdMinr008';

    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['NPRY_Titulo', 'NPRY_Keywords', 'NPRY_Duracion', 'NPRY_FechaR', 'NPRY_FechaL', 'NPRY_Estado'];

    /*
    *Función de conexión entre las tablas de Anteproyecto y Radicacion
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *seleccionando los campos PK_RDCN_IdRadicacion, RDCN_Min, RDCN_Requerimientos, FK_TBL_Anteproyecto_Id
    *para realizar las busquedas complementarias
    */
    public function radicacion()
    {
        return $this->hasOne(Radicacion::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->select('PK_RDCN_IdRadicacion', 'RDCN_Min', 'RDCN_Requerimientos', 'FK_TBL_Anteproyecto_Id');
    }

    /*
    *Función de relacion entre las tablas de Anteproyecto y Proyecto
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *para realizar las busquedas complementarias
    */
    public function proyecto()
    {
        return $this->hasOne(Proyecto::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *para realizar las busquedas complementarias
    */
    public function encargados()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *filtrando en la tabla de encargados por NCRD_Cargo y por el usuario con sesion activa
    *y utilizando la funcion de relacion de conceptos
    *para realizar las busquedas complementarias
    */
    public function conceptoFinal()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->where(function ($query) {
                $query->where('NCRD_Cargo', '=', "Jurado 1");
                $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
            })
            ->where('FK_Developer_User_Id', '=', Auth::user()->id)
            ->with(['conceptos']);
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *filtrando en la tabla de encargados por NCRD_Cargo
    *y utilizando la funcion de relacion de usuarios para traer el nombre del usuario correspondiente
    *para realizar las busquedas complementarias
    */
    public function director()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->where('NCRD_Cargo', '=', 'Director')
            ->with(['usuarios' => function ($usuarios) {
                $usuarios->select('name', 'lastname', 'id');
            }]);
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *filtrando en la tabla de encargados por NCRD_Cargo
    *y utilizando la funcion de relacion de usuarios para traer el nombre del usuario correspondiente
    *para realizar las busquedas complementarias
    */
    public function jurado1()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->where('NCRD_Cargo', '=', 'Jurado 1')
            ->with(['usuarios' => function ($usuarios) {
                $usuarios->select('name', 'lastname', 'id');
            }]);
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *filtrando en la tabla de encargados por NCRD_Cargo
    *y utilizando la funcion de relacion de usuarios para traer el nombre del usuario correspondiente
    *para realizar las busquedas complementarias
    */
    public function jurado2()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->where('NCRD_Cargo', '=', 'Jurado 2')
            ->with(['usuarios' => function ($usuarios) {
                $usuarios->select('name', 'lastname', 'id');
            }]);
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *filtrando en la tabla de encargados por NCRD_Cargo
    *y utilizando la funcion de relacion de usuarios para traer el nombre del usuario correspondiente
    *para realizar las busquedas complementarias
    */
    public function estudiante1()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->where('NCRD_Cargo', '=', 'Estudiante 1')
            ->with(['usuarios' => function ($usuarios) {
                $usuarios->select('name', 'lastname', 'id');
            }]);
    }

    /*
    *Función de relacion entre las tablas de Anteproyectos y Encargados
    *por los campo de FK_TBL_Anteproyecto_Id y PK_NPRY_IdMinr008
    *filtrando en la tabla de encargados por NCRD_Cargo
    *y utilizando la funcion de relacion de usuarios para traer el nombre del usuario correspondiente
    *para realizar las busquedas complementarias
    */
    public function estudiante2()
    {
        return $this->hasMany(Encargados::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->where('NCRD_Cargo', '=', 'Estudiante 2')
            ->with(['usuarios' => function ($usuarios) {
                $usuarios->select('name', 'lastname', 'id');
            }]);
    }

}
