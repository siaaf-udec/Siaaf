<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class UsuarioAudiovisuales extends Model
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
	protected $table = 'TBL_Usuario_Audiovisuales';
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
	protected $fillable = [
		'USER_FK_User', 'USER_FK_Programa'
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [

	];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Usuario_Audiovisuales' y la tabla 'users'
     * a través de la llave foránea ''USER_FK_User' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
	{
		return $this->belongsTo('App\Container\Users\Src\User', 'USER_FK_User');
	}
}
