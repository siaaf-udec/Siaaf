<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Documentacion_Extra extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Documentacion_Extra';
    protected $primaryKey = 'PK_Documentacion_Extra';
    protected $fillable = ['Descripcion','Ubicacion','Entidad','FK_TBL_Usuarios'];
    public function Usuario(){
        return $this->hasMany(Usuario::class);
    }
}
