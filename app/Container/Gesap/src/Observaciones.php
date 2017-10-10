<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Observaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Observaciones';

    protected $primaryKey = 'PK_BVCS_IdObservacion';

    protected $fillable = ['BVCS_Observacion','FK_TBL_Encargado_Id'];
    
    
    
    public function encargado()
    {
        return $this->belongsTo(Encargados::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo')
            ->select("PK_NCRD_IdCargo", "FK_TBL_Anteproyecto_Id", "FK_Developer_User_Id", "NCRD_Cargo")
            ->with(['usuarios'=>function ($usuarios) {
                            $usuarios->select('name', 'id');
            }]);
    }
    public function respuesta()
    {
        return $this->hasOne(Respuesta::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion')
            ->select("PK_RPST_IdMinr008", "RPST_RMin", "RPST_Requerimientos", "FK_TBL_Observaciones_Id");
    }
    public function check()
    {
        return $this->hasOne(checkObservaciones::class, 'FK_TBL_Observaciones_Id', 'PK_BVCS_IdObservacion');
    }
}
