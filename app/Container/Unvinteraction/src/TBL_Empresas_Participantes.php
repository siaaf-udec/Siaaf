<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Empresas_Participantes extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Empresas_Participantes';
    protected $primaryKey = 'PK_Empresas_Participantes';
    protected $fillable = ['FK_TBL_Convenios','FK_TBL_Empresa'];
}
