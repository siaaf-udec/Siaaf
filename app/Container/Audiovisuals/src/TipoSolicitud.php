<?php

// MODELO ADMINISTRADOR
namespace App\Container\Audiovisuals\src;

use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    protected $connection = 'audiovisuals';

    protected $table = 'TBL_Tipos_Solicitud';

    protected $fillable = [

        'TPSOL_Tipo',


    ];

    public function consultarArticulos()
    {
        return $this->hasMany(Articulo::class,'FK_ART_Tipo_id','id');
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
