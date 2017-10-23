<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Empresa extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Empresa';
    protected $primaryKey = 'PK_Empresa';
    protected $fillable = ['Nombre_Empresa','Razon_Social','Telefono','Direccion'];
    public function participante_Empresas()
    {
        return $this->hasMany(TBL_Empresas_Participantes::class, 'FK_TBL_Empresa', 'PK_Empresa');
    }
}
