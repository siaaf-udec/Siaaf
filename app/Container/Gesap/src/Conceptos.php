<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Conceptos';

    protected $primaryKey = 'PK_CNPT_Conceptos';

    protected $fillable = ['CNPT_Concepto','CNPT_Tipo','FK_TBL_Encargado_Id'];
    
}
