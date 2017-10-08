<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Observaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'tbl_observaciones';

    protected $primaryKey = 'PK_BVCS_idObservacion';

    protected $fillable = ['BVCS_Observacion','FK_TBL_Encargado_id'];
    
    public function encargado()
    {
        return $this->belongsTo(Encargados::class, 'FK_TBL_Encargado_id', 'PK_NCRD_idCargo')
            ->select("PK_NCRD_idCargo", "FK_TBL_Anteproyecto_id", "FK_developer_user_id", "NCRD_Cargo")
            ->with(['usuarios'=>function ($usuarios) {
                            $usuarios->select('name', 'id');
            }]);
    }
    public function respuesta()
    {
        return $this->hasOne(Respuesta::class, 'FK_TBL_Observaciones_id', 'PK_BVCS_idObservacion')
            ->select("PK_RPST_idMinr008", "RPST_RMin", "RPST_Requerimientos", "FK_TBL_Observaciones_id");
    }
    public function check()
    {
        return $this->hasOne(checkObservaciones::class, 'FK_TBL_Observaciones_id', 'PK_BVCS_idObservacion');
    }
}
