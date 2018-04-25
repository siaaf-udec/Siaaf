<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//use App\Container\Users\src\UsersUdec;

class Procedencia extends Model
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
    protected $table = 'TBL_Procedencias';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_PRO_Id_Procedencia';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'PRO_Nombre'         
    ];
    /**
     *  Función que retorna la relación entre la tabla 'tbl_procedencias' y la tabla
     * 'tb_articulos' a través de la llave foránea 'fk_id_procedencia'
     *  y la llave 'pk_id_procedencia'
     */
    public function articulo()
    {
        return $this->hasMany(Articulo::class, 'FK_ART_Id_Procedencia', 'PK_PRO_Id_Procedencia');
    }
   
   
}
