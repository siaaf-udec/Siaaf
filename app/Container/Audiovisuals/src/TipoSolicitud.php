<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
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
    protected $table = 'TBL_Tipos_Solicitud';
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = [
        'TPSOL_Tipo',
    ];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Tipos_Solicitud' y la tabla 'TBL_Articulos'
     * a través de la llave foránea 'FK_ART_Tipo_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultarArticulos()
    {
        return $this->hasMany(Articulo::class,'FK_ART_Tipo_id','id');
    }
}
