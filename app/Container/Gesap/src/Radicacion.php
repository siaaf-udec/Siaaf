<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Radicacion extends Model
{
        protected $connection = 'gesap';

    protected $table = 'TBL_Radicacion';

    protected $primaryKey = 'PK_RDCN_idRadicacion';

    protected $fillable = ['RDCN_Min','RDCN_Requerimientos','FK_TBL_Anteproyecto_id'];
    
    public function anteproyectos() {
        return $this->hasOne('App\container\gesap\src\Radicacion','FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
}
