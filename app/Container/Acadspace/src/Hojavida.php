<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//use App\Container\Users\src\UsersUdec;

class Hojavida extends Model
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
    protected $table = 'TBL_Hojavida';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_HOJ_Id_Hojavida';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'HOJ_Modelo_Equipo',
        'HOJ_Procesador',
        'HOJ_Memoria_Ram',
        'HOJ_Disco_Duro',
        'HOJ_Mouse',
        'HOJ_Teclado',
        'HOJ_Sistema_Operativo',
        'HOJ_Antivirus',
        'HOJ_Garantia',
        'FK_HOJ_Id_Marca'
    ];
    /**
     *  Función que retorna la relación entre la tabla 'TBL_Hojavida' y la tabla
     * 'TBL_Marca' a través de la llave foránea 'FK_HOJ_Id_Marca'
     *  y la llave 'PK_MAR_Id_Marca'
     */
    public function marca()
    {
        return $this->hasMany(Marca::class, 'PK_MAR_Id_Marca', 'FK_HOJ_Id_Marca');
    }
}
