<?php

namespace App\Container\Acadspace\src;


use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
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
    protected $table = 'TBL_Asistencias';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_ASIS_Id_Registro';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'ASIS_Id_Identificacion',
        'ASIS_Espacio_Academico',
        'ASIS_Espacio',
        'ASIS_Tipo_Practica',
        'ASIS_Id_Carrera',
        'ASIS_Nombre_Materia',
        'ASIS_Cant_Estudiantes',
        'FK_ASIS_Id_Aula',
        'FK_ASIS_Id_Espacio'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Espacios' y la tabla
     * 'TBL_Asistencias' a través de la llave foránea 'FK_ASIS_Id_Espacio'
     *  y la llave 'PK_ESP_Id_Espacio'
     */
    public function espacios()
    {
        return $this->hasMany(Espacios::class, 'FK_ASIS_Id_Espacio', 'PK_ESP_Id_Espacio');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Aulas' y la tabla
     * 'TBL_Asistencias' a través de la llave foránea 'FK_ASIS_Id_Aula'
     *  y la llave 'PK_SAL_Id_Sala'
     */
    public function aulas()
    {
        return $this->hasMany(Aulas::class, 'FK_ASIS_Id_Aula', 'PK_SAL_Id_Sala');
    }
    // 
}