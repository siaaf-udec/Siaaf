<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EstadoAnteproyecto extends Model
{
    //este modelo dicta el estado del proyecto
    protected $connection = 'gesap';

    protected $table = 'TBL_Estado_Anteproyecto';

    protected $primaryKey = 'PK_EST_Id';

    protected $fillable = [
        'EST_Estado'
        ,
    ];
    //los proyectos que estan en cierto estado
    public function relacionAnteproyecto()
    {
        return $this->hasMany(Anteproyecto::class, 'FK_NPRY_Estado', 'PK_EST_Id');
    }
}