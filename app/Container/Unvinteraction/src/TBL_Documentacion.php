<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Documentacion extends Model
{
     public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'TBL_Documentacion';
    protected $primaryKey = 'PK_Documentacion';
    protected $fillable = [
        'Entidad','Ubicacion','FK_TBL_Convenios'];
}
