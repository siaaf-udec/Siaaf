<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitudes extends Model
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
    protected $table = "TBL_Prestamos";

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
		'PRT_FK_Articulos_id','PRT_FK_Funcionario_id','PRT_FK_Kits_id',
		'PRT_Fecha_Inicio','PRT_Fecha_Fin','PRT_Observacion_Entrega',
		'PRT_Observacion_Recibe','PRT_Num_Orden','PRT_Cantidad','PRT_FK_Estado','PRT_FK_Tipo_Solicitud',
		'PRT_FK_Administrador_Entrega_id','PRT_FK_Administrador_Recibe_id'
	];

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'TBL_Articulos'
     * a través de la llave foránea 'PRT_FK_Articulos_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaArticulos()
    {
        return $this->belongsTo(Articulo::class,'PRT_FK_Articulos_id');
    }

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'TBL_Usuario_Audiovisuales'
     * a través de la llave foránea 'PRT_FK_Funcionario_id' y la llave 'USER_FK_User'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaUsuarioAudiovisuales()
	{
		return $this->belongsTo(UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','USER_FK_User');
	}

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'users'
     * a través de la llave foránea 'PRT_FK_Funcionario_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function	conultarUsuarioDeveloper(){
		return $this->belongsTo('App\Container\Users\Src\User','PRT_FK_Funcionario_id','id');
	}

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'users'
     * a través de la llave foránea 'PRT_FK_Administrador_Entrega_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function	consultarAdministradorEntrega(){
        return $this->belongsTo(UsuarioAudiovisuales::class,'PRT_FK_Administrador_Entrega_id','USER_FK_User');
    }

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'users'
     * a través de la llave foránea 'PRT_FK_Administrador_Recibe_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function	consultarAdministradorRecibe(){
        return $this->belongsTo(UsuarioAudiovisuales::class,'PRT_FK_Administrador_Recibe_id','USER_FK_User');
    }

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'TBL_Kits'
     * a través de la llave foránea 'PRT_FK_Kits_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaKitArticulo()
	{
		return $this->belongsTo(Kit::class,'PRT_FK_Kits_id');
	}

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'TBL_Tipo_Articulos'
     * a través de la llave foránea 'PRT_FK_Articulos_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaTipoArticulo()
	{
		return $this->belongsTo(
			TipoArticulo::class,'PRT_FK_Articulos_id','id'
		);
	}

    /**
     * Función que retorna la relación entre la tabla 'TBL_Prestamos' y la tabla 'TBL_Usuario_Audiovisuales'
     * a través de la llave foránea 'PRT_FK_Funcionario_id' y la llave 'id'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaUsuario()
	{
		return $this->belongsTo(
			UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','id'
		);
	}
}
