<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Facultad extends Model
{
	public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'TBL_Facultad';
    protected $primaryKey = 'PK_Facultad';
    protected $fillable = [
        'PK_Facultad','Facultad',
    ];
    public function Carrera(){
        return $this->hasMany(Carrera::class);
    }
}

