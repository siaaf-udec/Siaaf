<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EstadoAnteproyecto extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'tbl_estado_anteproyecto';

    protected $primaryKey = 'PK_EST_id';

    protected $fillable = [
        'EST_Estado'
        ,
    ];

    public function relacionAnteproyecto()
    {
        return $this->belongsToMany(Anteproyecto::class, 'FK_NPRY_Estado', 'PK_EST_id');
    }
}