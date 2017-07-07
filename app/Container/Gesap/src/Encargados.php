<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Encargados extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Encargados';

    protected $primaryKey = 'PK_NPRY_idCargo';

    protected $fillable = ['FK_TBL_Anteproyecto_id','NCRD_Usuario','NCRD_Cargo'];
    
    
    
    



}
