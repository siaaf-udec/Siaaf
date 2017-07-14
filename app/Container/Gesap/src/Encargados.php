<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Encargados extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Encargados';

    protected $primaryKey = 'PK_NPRY_idCargo';

    protected $fillable = ['FK_TBL_Anteproyecto_id','FK_TBL_Usuarios_id','NCRD_Cargo'];
    
    
    
    



}
