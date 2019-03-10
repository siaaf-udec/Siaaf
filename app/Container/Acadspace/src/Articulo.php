<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Articulo extends Model
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
    protected $table = 'TBL_Articulos';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_ART_Id_Articulo';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'ART_Codigo',
        'ART_Descripcion',
        'FK_ART_Id_Categoria',
        'FK_ART_Id_Procedencia',
        'FK_ART_Id_Hojavida'        
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla
     * 'TBL_Categorias' a través de la llave foránea 'FK_ART_Id_Categoria'
     *  y la llave 'PK_CAT_Id_Categoria'
     */

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'PK_CAT_Id_Categoria', 'FK_ART_Id_Categoria');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla
     * 'TBL_Procedencias' a través de la llave foránea 'FK_ART_Id_Procedencia'
     *  y la llave 'PK_PRO_Id_Procedencia'
     */

    public function procedencia()
    {
        return $this->hasOne(Procedencia::class, 'PK_PRO_Id_Procedencia', 'FK_ART_Id_Procedencia');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla
     * 'TBL_Hojavida' a través de la llave foránea 'FK_ART_Id_Hojavida'
     *  y la llave 'PK_HOJ_Id_Hojavida'
     */

    public function hojavida()
    {
        return $this->hasOne(Hojavida::class, 'PK_HOJ_Id_Hojavida', 'FK_ART_Id_Hojavida');
    }
}
