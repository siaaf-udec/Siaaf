<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//use App\Container\Users\src\UsersUdec;

class Marca extends Model
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
    protected $table = 'tbl_marca_equipos';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'pk_id_marca_equipo';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'tipo_marca'         
    ];
    /**
     *  Función que retorna la relación entre la tabla 'tbl_marca_equipos' y la tabla
     * 'tb_hojavida' a través de la llave foránea 'fk_id_marca_equipo'
     *  y la llave 'pk_id_marca_equipo'
     */
    public function articulo()
    {
        return $this->hasMany(Articulo::class, 'fk_id_marca_equipo', 'pk_id_marca_equipos');
    }
   
   
}
