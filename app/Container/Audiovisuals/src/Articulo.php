<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Articulos';
    protected $dates = ['deleted_at'];
    protected $fillable = [

		'FK_ART_Tipo_id','ART_Descripcion','FK_ART_Kit_id', 'FK_ART_Estado_id' ,
		'ART_Codigo'
    ];

	public function consultaTipoArticulo()
	{
		return $this->belongsTo(TipoArticulo::class,'FK_ART_Tipo_id','id');
	}
	public function consultaKitArticulo()
	{
		return $this->belongsTo(Kit::class,'FK_ART_Kit_id','id');
	}
	public function consultaEstadoArticulo()
	{
		return $this->belongsTo(Estado::class,'FK_ART_Estado_id','id');
	}
    public function Asistents()
    {
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments()
    {
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions()
    {
        return $this->hasMany(Induction::class);
    }
    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
