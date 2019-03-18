<?php

namespace App\Container\Acadspace\src;

use App\Container\Users\src\User;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     * @var string
     */
    protected $connection = 'acadspace';

    /**
     * Tabla utilizada por el modelo.
     * @var string
     */
    protected $table = 'TBL_Solicitud';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_SOL_Id_Solicitud';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'SOL_Guia_Practica',
        'FK_SOL_Id_Software',
        'SOL_Grupo',
        'SOL_Cant_Estudiantes',
        'FK_SOL_Id_Docente',
        'SOL_Dias',
        'SOL_Hora_Fin',
        'SOL_Hora_Inicio',
        'SOL_Estado',
        'SOL_Nucleo_Tematico',
        'SOL_Id_Practica',
        'FK_SOL_Id_Sala',
        'SOL_Carrera',
        'SOL_Espacio',
        'SOL_Rango_Fechas'

    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_solicitud' y la tabla
     * 'developer.Users' a través de la llave foránea 'FK_SOL_Id_Docente'
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'FK_SOL_Id_Docente');
    }


    /**
     *  Función que retorna la relación entre la tabla 'TBL_solicitud' y la tabla
     * 'TBL_Comentarios' a través de la llave foránea 'FK_COM_Id_Solicitud'
     *  y la llave 'PK_SOL_Id_Solicitud'
     */
    public function coment()
    {
        return $this->hasOne(Comentarios::class, 'FK_COM_Id_Solicitud', 'PK_SOL_Id_Solicitud');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_solicitud' y la tabla
     * 'TBL_Aulas' a través de la llave foránea 'FK_SOL_Id_Sala'
     *  y la llave 'PK_SAL_Id_Sala'
     */
    public function aula()
    {
        return $this->hasOne(Aulas::class, 'PK_SAL_Id_Sala', 'FK_SOL_Id_Sala');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_solicitud' y la tabla
     * 'TBL_Software' a través de la llave foránea 'FK_SOL_Id_Software'
     *  y la llave 'PK_SOF_Id'
     */
    public function software()
    {
        return $this->hasOne(Software::class, 'PK_SOF_Id', 'FK_SOL_Id_Software');
    }
    //
}
