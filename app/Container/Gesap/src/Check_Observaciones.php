<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Check_Observaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'tbl_check_observaciones';

    protected $primaryKey = 'PK_CBSV_id';

    protected $fillable = ['CBSV_Estudiante1','CBSV_Estudiante2','CBSV_Director','FK_TBL_Observaciones_id'];


}
