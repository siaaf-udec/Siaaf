<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
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
    protected $table = 'TBL_Comentarios';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_COM_Id_Comentario';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'COM_Comentario',
        'FK_COM_Id_Solicitud'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Comentarios' y la tabla
     * 'TBL_Solicitud' a través de la llave foránea 'FK_COM_Id_Solicitud'
     *  y la llave 'PK_SOL_Id_Solicitud'
     */
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class,'FK_COM_Id_Solicitud', 'PK_SOL_Id_Solicitud');
    }
}
