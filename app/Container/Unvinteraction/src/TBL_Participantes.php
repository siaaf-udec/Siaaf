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
    public function convenios_Participantes()
    {
        return $this->belongsto(TBL_Convenios::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    public function usuarios_Participantes()
    {
        return $this->belongsto('App\Container\Users\Src\User', 'FK_TBL_Usuarios', 'identity_no');
    }
}
