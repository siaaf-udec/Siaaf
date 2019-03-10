<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EstadoAnteproyecto extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_estado_anteproyecto';

    protected $primaryKey = 'PK_EST_Id';

    protected $fillable = [
        'EST_Estado'
        ,
    ];

    public function relacionAnteproyecto()
    {
        return $this->hasMany(Anteproyecto::class, 'FK_NPRY_Estado', 'PK_EST_Id');
    }
}