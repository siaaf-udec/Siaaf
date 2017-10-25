<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Radicacion extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Radicacion';

    protected $primaryKey = 'PK_RDCN_IdRadicacion';

    protected $fillable = ['RDCN_Min','RDCN_Requerimientos','FK_TBL_Anteproyecto_Id'];
    
}
