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
}
