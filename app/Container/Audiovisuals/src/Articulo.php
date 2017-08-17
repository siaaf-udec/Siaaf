<?php

namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Articulos';

    protected $fillable = [

        'FK_ART_Tipo_id', 'ART_Nombre', 'FK_ART_Kit_id', 'FK_ART_Estado_id',
    ];

    public function consultaTipoArticulo()
    {
        return $this->belongsTo(TipoArticulo::class,'id','id');
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
