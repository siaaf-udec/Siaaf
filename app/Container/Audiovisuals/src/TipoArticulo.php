<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
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
    protected $table = 'TBL_Tipo_Articulos';
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [
        'TPART_Nombre',
		'TPART_Tiempo',
        'TPART_HorasMantenimiento'
    ];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Tipo_Articulos' y la tabla 'TBL_Articulos'
     * a través de la llave foránea 'FK_ART_Tipo_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultarArticulos()
    {
        return $this->hasMany(Articulo::class,'FK_ART_Tipo_id','id');
    }

    /**
     * Función que retorna la relación entre la tabla 'TBL_Tipo_Articulos' y la tabla 'TBL_Validaciones'
     * a través de la llave foránea 'TPART_Tiempo' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultarTiempoAsignado()
    {
        return $this->belongsTo(Validaciones::class,'TPART_Tiempo','id');
    }

}