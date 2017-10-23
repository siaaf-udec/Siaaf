<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Estado extends Model
{
    public $timestamps    = false;
    protected $connection ='unvinteraction';
    protected $table      = 'TBL_Estado';
    protected $primaryKey = 'PK_Estado';
    protected $fillable   = ['Estado'];
    public function convenios_Estados()
    
    public function convenios_Estados()
    {
        return $this->hasMany(TBL_Convenios::class, 'FK_TBL_Estado', 'PK_Estado');
    }
}
