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
    protected $table = 'TBL_Marca';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_MAR_Id_Marca';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'MAR_Nombre'         
    ];
    /**
     *  Función que retorna la relación entre la tabla 'TBL_Marca' y la tabla
     * 'TBL_Hojavida' a través de la llave foránea 'FK_HOJ_Id_Marca'
     *  y la llave 'PK_MAR_Id_Marca'
     */
    public function hojavida()
    {
        return $this->hasMany(Hojavida::class, 'FK_HOJ_Id_Marca', 'PK_MAR_Id_Marca');
    }
   
   
}
