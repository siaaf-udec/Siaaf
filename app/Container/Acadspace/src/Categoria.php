<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//use App\Container\Users\src\UsersUdec;

class Categoria extends Model
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
    protected $table = 'tbl_categorias';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'pk_id_categoria';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'nombre_categoria'
            
    ];   
    /**
     *  Función que retorna la relación entre la tabla 'tbl_categorias' y la tabla
     * 'tb_articulos' a través de la llave foránea 'fk_id_categoria'
     *  y la llave 'pk_id_categoria'
     */
    public function articulo()
    {
        return $this->hasMany(Articulo::class, 'fk_id_categoria', 'pk_id_categoria');
    }
        
}
