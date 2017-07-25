<?php

namespace App\container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Convenios extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Convenios';
    protected $primaryKey = 'PK_Convenios';
    protected $fillable =['Nombre','Fecha_Inicio','Fecha_Fin','FK_TBL_Documentacion','FK_TBL_Evaluacion','FK_TBL_Estado','FK_TBL_Sede'];

}
