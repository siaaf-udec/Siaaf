<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Tipo_Articulos';

    protected $fillable = [

        'TPART_Nombre',
    ];
    public function consultaTipoArticulo2()
    {
        return $this->hasMany(Articulo::class,'FK_ART_Tipo_id');
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
