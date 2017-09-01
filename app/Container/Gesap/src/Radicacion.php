<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Radicacion extends Model
{
        protected $connection = 'gesap';

    protected $table = 'TBL_Radicacion';

    protected $primaryKey = 'PK_RDCN_idRadicacion';

    protected $fillable = ['RDCN_Min','RDCN_Requerimientos','FK_TBL_Anteproyecto_id'];
    
    public function anteproyecto() {
        return $this->belongsTo('App\container\gesap\src\Radicacion','FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
}
