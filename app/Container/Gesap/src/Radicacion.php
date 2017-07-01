<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Radicacion extends Model
{
        protected $connection = 'gesap';

    protected $table = 'TBL_Radicacion';

    protected $primaryKey = 'PK_RDCN_idRadicacion';

    protected $fillable = ['RDCN_Min','RDCN_Requerimientos'];
}
