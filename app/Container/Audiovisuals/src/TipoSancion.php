<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 19/04/2018
 * Time: 8:53 PM
 */

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;
class TipoSancion extends Model
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
    protected $table = "TBL_Tipo_Sanciones";

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
        'TIPO_Nombre',
            'TIPO_Descripcion',
    ];

}