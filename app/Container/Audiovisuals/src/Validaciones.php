<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Validaciones extends Model
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
    protected $table  = "TBL_Validaciones";
    /**
     * Atributos que son asignables.
     *
     * @var array
     */
	protected $fillable = [
		'VAL_PRE_Nombre','VAL_PRE_Valor'
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultaTimepoArticulo(){
		return $this->hasMany(TipoArticulo::class,'TPART_Tiempo','id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultaTimepoKit(){
        return $this->hasMany(Kit::class,'KIT_FK_Tiempo','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaUsuarioAudiovisuales()
	{
		return $this->belongsTo(UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function	conultarUsuarioDeveloper(){
		return $this->belongsTo('App\Container\Users\Src\User','PRT_FK_Funcionario_id','id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaKitArticulo()
	{
		return $this->belongsTo(Kit::class,'PRT_FK_Kits_id','id');
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaTipoArticulo()
	{
		return $this->belongsTo(
			TipoArticulo::class,'PRT_FK_Articulos_id','id'
		);
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultaUsuario()
	{
		return $this->belongsTo(
			UsuarioAudiovisuales::class,'PRT_FK_Funcionario_id','id'
		);
	}
}
