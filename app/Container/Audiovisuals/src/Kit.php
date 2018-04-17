<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kit extends Model
{
    use SoftDeletes;
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Kits';
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'KIT_Nombre',
        'KIT_FK_Estado_id',
        'KIT_FK_Tiempo',
        'KIT_Codigo'
    ];
    public function consultaArticulos()
    {
        return $this->hasMany(Articulo::class,'FK_ART_Kit_id');
    }
    public function consultarTiempoAsignadoKit()
    {
        return $this->belongsTo(Validaciones::class,'KIT_FK_Tiempo','id');
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
