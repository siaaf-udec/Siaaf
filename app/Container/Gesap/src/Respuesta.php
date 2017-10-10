<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Respuesta extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Respuesta';

    protected $primaryKey = 'PK_RPST_IdMinr008';

    protected $fillable = ['RPST_RMin','RPST_Requerimientos','FK_TBL_Radicacion_Id'];
    
    public function observaciones()
    {
        return $this->belongsto(Observaciones::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion');
    }
}
