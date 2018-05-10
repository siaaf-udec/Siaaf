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

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'PK_CAT_Id_Categoria', 'FK_ART_Id_Categoria');
    }
    public function procedencia()
    {
        return $this->hasOne(Procedencia::class, 'PK_PRO_Id_Procedencia', 'FK_ART_Id_Procedencia');
    }
    public function hojavida()
    {
        return $this->hasOne(Hojavida::class, 'PK_HOJ_Id_Hojavida', 'FK_ART_Id_Hojavida');
    }
}
