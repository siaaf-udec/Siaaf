<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Incidentes extends Model
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
    protected $table = 'TBL_Incidentes';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_INC_Id_Incidente';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'FK_INC_Id_User',
        'FK_INC_Id_Espacio',
        'FK_INC_Id_Articulo',
        'INC_Descripcion'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'tbl_incidentes' y la tabla
     * 'TBL_Espacio' a través de la llave foránea 'FK_INC_Id_Espacio'
     *  y la llave 'PK_ESP_Id_Espacio'
     */
    public function espacio()
    {
        return $this->hasOne(Espacios::class, 'PK_ESP_Id_Espacio', 'FK_INC_Id_Espacio');
    }
    public function articulo()
    {
        return $this->hasOne(Articulo::class, 'PK_ART_Id_Articulo', 'FK_INC_Id_Articulo');
    }


}