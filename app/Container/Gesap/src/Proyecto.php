<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Proyecto';

    protected $primaryKey = 'PK_PRYT_IdProyecto';

    protected $fillable = ['PRYT_Estado','FK_TBL_Anteproyecto_Id'];

    public function anteproyecto()
    {
        return $this->belongsto(Anteproyecto::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }
    
     public function documentos()
    {
        return $this->hasMany(Documentos::class, 'FK_TBL_Proyecto_Id', 'PK_PRYT_IdProyecto');
    }
}
