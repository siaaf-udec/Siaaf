<?php

namespace App\Container\Acadspace\src;


use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
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
    protected $table = 'TBL_Aulas';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_SAL_Id_Sala';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'SAL_Nombre_Sala',
        'FK_SAL_Id_Espacio'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Espacios' y la tabla
     * 'TBL_Aulas' a través de la llave foránea 'FK_SAL_Id_Espacio'
     *  y la llave 'PK_ESP_Id_Espacio'
     */
    public function espacio()
    {
        return $this->hasOne(Espacios::class, 'PK_ESP_Id_Espacio', 'FK_SAL_Id_Espacio');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Solicitud' y la tabla
     * 'TBL_Aulas' a través de la llave foránea 'FK_SOL_Id_Sala'
     *  y la llave 'PK_SAL_Id_Sala'
     */
    public function solicitud()
    {
        return $this->hasMany(Solicitud::class, 'FK_SOL_Id_Sala', 'PK_SAL_Id_Sala');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Solicitud' y la tabla
     * 'TBL_Aulas' a través de la llave foránea 'FK_SOL_Id_Sala'
     *  y la llave 'PK_SAL_Id_Sala'
     */
    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'FK_ASIS_Id_Espacio', 'PK_SAL_Id_Sala');
    }
}