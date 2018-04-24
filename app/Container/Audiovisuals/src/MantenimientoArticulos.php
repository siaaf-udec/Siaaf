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
		'TMT_FK_Id_Articulo','TMT_Cantidad_Mantenimiento','TMT_Observacion'
	];











}
