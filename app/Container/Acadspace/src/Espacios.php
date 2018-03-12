<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Espacios extends Model
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
    protected $table = 'TBL_Espacios';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_ESP_Id_Espacio';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'ESP_Nombre_Espacio'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Espacios' y la tabla
     * 'TBL_Aulas' a través de la llave foránea 'FK_SAL_Id_Espacio'
     *  y la llave 'PK_ESP_Id_Espacio'
     */
    public function aulas()
    {
        return $this->hasMany(Aulas::class, 'FK_SAL_Id_Espacio', 'PK_ESP_Id_Espacio');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Espacios' y la tabla
     * 'TBL_Incidentes' a través de la llave foránea 'FK_INC_Id_Espacio'
     *  y la llave 'PK_ESP_Id_Espacio'
     */
    public function incidentes()
    {
        return $this->hasMany(Incidentes::class, 'FK_INC_Id_Espacio', 'PK_ESP_Id_Espacio');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Espacios' y la tabla
     * 'TBL_Asistencias' a través de la llave foránea 'FK_ASIS_Id_Espacio'
     *  y la llave 'PK_ESP_Id_Espacio'
     */
    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'FK_ASIS_Id_Espacio', 'PK_ESP_Id_Espacio');
    }
}
