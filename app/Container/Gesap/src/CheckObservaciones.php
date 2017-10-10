<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class CheckObservaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Check_Observaciones';

    protected $primaryKey = 'PK_CBSV_Id';

    protected $fillable = ['CBSV_Estudiante1','CBSV_Estudiante2','CBSV_Director','FK_TBL_Observaciones_Id'];

    public function observaciones()
    {
        return $this->belongsto(Observaciones::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion');
    }
}
