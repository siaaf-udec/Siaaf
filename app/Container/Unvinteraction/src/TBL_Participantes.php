<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Participantes extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Participantes';
    protected $primaryKey = 'PK_Participantes';
    protected $fillable = ['FK_TBL_Convenios','FK_TBL_Usiarios'];
}
