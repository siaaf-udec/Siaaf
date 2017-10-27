<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
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
    protected $table = 'TBL_Software';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_SOF_Id';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'SOF_Nombre_Soft',
        'SOF_Version',
        'SOF_Licencias'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Software' y la tabla
     * 'TBL_Solicitud' a través de la llave foránea 'FK_SOL_Id_Software'
     *  y la llave 'PK_SOF_Id'
     */
    public function solicitud()
    {
        return $this->hasOne(Solicitud::class, 'PK_SOF_Id', 'FK_SOL_Id_Software');
    }

}
