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
    protected $table = 'tbl_articulos';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'pk_id_articulo';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'codigo_articulo',
        'descripcion_articulo',
        'fk_id_categoria',
        'fk_id_procedencia',
        'fk_id_hojavida'        
    ];

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'pk_id_categoria', 'fk_id_categoria');
    }
    public function procedencia()
    {
        return $this->hasOne(Procedencia::class, 'pk_id_procedencia', 'fk_id_procedencia');
    }
}
