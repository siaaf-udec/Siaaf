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
    protected $table = 'tbl_procedencias';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'pk_id_procedencia';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'tipo_procedencia'         
    ];

    public function articulo()
    {
        return $this->hasMany(Articulo::class, 'fk_id_procedencia', 'pk_id_procedencia');
    }
   
   
}
