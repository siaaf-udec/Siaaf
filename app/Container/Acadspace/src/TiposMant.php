<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//use App\Container\Users\src\UsersUdec;

class TiposMant extends Model
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
    protected $table = 'TBL_Tipo_Mantenimientos';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_MAN_Id_Tipo';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'MAN_Nombre',
        'MAN_Descripcion'
            
    ];   
    /**
     *  Función que retorna la relación entre la tabla 'TBL_Registro_Mantenimientos' y la tabla
     * 'TBL_Tipos_Mantenimientos' a través de la llave foránea 'FK_MAN_Id_Tipo'
     *  y la llave 'PK_MAN_Id_Tipo'
     */
    public function mantenimiento()
    {
        return $this->hasMany(Mantenimiento::class, 'FK_MAN_Id_Tipo', 'PK_MAN_Id_Tipo');
    }
        
}
