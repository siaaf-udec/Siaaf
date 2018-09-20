<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Imagen extends Model
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
    protected $table = 'TBL_Imagenes';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_IMA_Id_Imagen';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'IMA_Ruta',
        'IMA_Nombre',
        'FK_IMA_Id_Articulo'   
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla
     * 'TBL_Imagenes' a través de la llave foránea 'FK_IMA_Id_Articulo'
     *  y la llave 'PK_ART_Id_Articulo'
     */

    public function articulo()
    {
        return $this->hasOne(Articulo::class, 'PK_ART_Id_Articulo', 'FK_IMA_Id_Articulo');
    }

}
