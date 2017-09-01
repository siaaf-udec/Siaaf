<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'tbl_observaciones';

    protected $primaryKey = 'PK_BVCS_idObservacion';

    protected $fillable = ['BVCS_Observacion','FK_TBL_Encargado_id'];
    
    public function encargado() {
        return $this->belongsTo('App\container\gesap\src\Encargados','FK_TBL_Encargado_id','PK_NCRD_idCargo');
    }
    public function respuesta() {
        return $this->hasOne('App\container\Users\src\Respuesta','FK_TBL_Observaciones_id','PK_BVCS_idObservacion');
    }
    public function check() {
        return $this->hasOne('App\container\Users\src\Check_Observaciones','FK_TBL_Observaciones_id','PK_BVCS_idObservacion');
    }

}

