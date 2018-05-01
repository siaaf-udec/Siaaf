<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class MantenimientoArticulos extends Model
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
    protected $table  = "TBL_Mantenimiento_Articulos";
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
	protected $fillable = [
		'TMT_FK_Id_Articulo',
        'TMT_Observacion_Finaliza',
        'TMT_Observacion_Realiza',
        'FK_TMT_Estado_id',
        'FK_TMT_Tipo_Solicitud',
        'TMT_Tipo_Articulo'
	];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Tipo_Articulos' y la tabla 'TBL_Articulos'
     * a través de la llave foránea 'FK_ART_Tipo_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultarArticulo()
    {
        return $this->belongsTo(Articulo::class,'TMT_FK_Id_Articulo','id');
    }




}
