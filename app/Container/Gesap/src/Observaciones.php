<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Observaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'tbl_observaciones';

    protected $primaryKey = 'PK_BVCS_idObservacion';

    protected $fillable = ['BVCS_Observacion','FK_TBL_Encargado_id'];
    
}
