<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class calendarioSalones extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_calendarioporaula';

    protected $primaryKey = 'PK_CAL_id';

    protected $fillable = [
        'CAL_fecha_ini',
        'CAL_fecha_fin',
        'CAL_todoeldia',
        'CAL_color',
        'CAL_titulo',
        'CAL_sala'
    ];

    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions(){
        return $this->hasMany(Induction::class);
    }
    public function Permissions(){
        return $this->hasMany(Permission::class);
    }
    // 
}