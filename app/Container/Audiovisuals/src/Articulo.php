<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
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
    protected $table = 'TBL_Articulos';
    /**
     * Atributo softdelete
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
		'FK_ART_Tipo_id','ART_Descripcion','FK_ART_Kit_id', 'FK_ART_Estado_id' ,
		'ART_Codigo','ART_Cantidad_Mantenimiento'
    ];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla 'TBL_Tipo_Articulos'
     * a través de la llave foránea 'FK_ART_Tipo_id' y la llave 'id'
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaTipoArticulo()
	{
		return $this->belongsTo(TipoArticulo::class,'FK_ART_Tipo_id','id');
	}

    /**
     * Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla 'TBL_Kit'
     * a través de la llave foránea 'FK_ART_Kit_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaKitArticulo()
	{
		return $this->belongsTo(Kit::class,'FK_ART_Kit_id','id');
	}
    /**
     * Función que retorna la relación entre la tabla 'TBL_Articulos' y la tabla 'TBL_Estados'
     * a través de la llave foránea 'FK_ART_Estado_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaEstadoArticulo()
	{
		return $this->belongsTo(Estado::class,'FK_ART_Estado_id','id');
	}
}
