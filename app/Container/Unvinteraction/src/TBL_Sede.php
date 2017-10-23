<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Sede extends Model
{
    //
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Sede';
    protected $primaryKey = 'PK_Sede';
    protected $fillable = ['Sede'];
    public function convenios_Sedes()
    {
        return $this->hasMany(TBL_Convenios::class, 'FK_TBL_Sede', 'PK_Sede');
    }
    
}
