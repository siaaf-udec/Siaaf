<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kit extends Model
{
    use SoftDeletes;
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'audiovisuals';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Kits';
    /**
     * Atributo softdelete.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [
        'KIT_Nombre',
        'KIT_FK_Estado_id',
        'KIT_FK_Tiempo',
        'KIT_Codigo'
    ];

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Kits' y la tabla 'TBL_Articulos'
     *  a través de la llave foránea 'FK_ART_Kit_id'
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultaArticulos()
    {
        return $this->hasMany(Articulo::class,'FK_ART_Kit_id');
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Kits' y la tabla 'TBL_Validaciones'
     *  a través de la llave foránea 'KIT_FK_Tiempo' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultarTiempoAsignadoKit()
    {
        return $this->belongsTo(Validaciones::class,'KIT_FK_Tiempo','id');
    }

}
