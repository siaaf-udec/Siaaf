<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
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
	protected $table      = "TBL_Programas";
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
	protected $fillable   = ['id', 'PRO_Nombre'];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'TBL_Usuario_Audiovisuales'
     * a través de la llave foránea 'PRT_FK_Funcionario_id' y la llave 'USER_FK_User'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaUsuarioAudiovisuales()
    {
        return $this->belongsTo(UsuarioAudiovisuales::class,'id','USER_FK_Programa');
    }
}
