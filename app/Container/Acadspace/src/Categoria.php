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
    protected $table = 'TBL_Categorias';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_CAT_Id_Categoria';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'CAT_Nombre'
            
    ];   
    /**
     *  Función que retorna la relación entre la tabla 'TBL_Categoria' y la tabla
     * 'TBL_Articulos' a través de la llave foránea 'FK_ART_Id_Categoria'
     *  y la llave 'PK_CAT_Id_Categoria'
     */
    public function articulo()
    {
        return $this->hasMany(Articulo::class, 'FK_ART_Id_Categoria', 'PK_CAT_Id_Categoria');
    }
        
}
