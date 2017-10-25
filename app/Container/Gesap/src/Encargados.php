<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Encargados extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Encargados';

    protected $primaryKey = 'PK_NCRD_IdCargo';

    protected $fillable = ['FK_TBL_Anteproyecto_Id','FK_Developer_User_Id','NCRD_Cargo'];
    
    
    
    public function anteproyecto()
    {
        return $this->belongsTo(Anteproyecto::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
    }
    public function observaciones()
    {
        return $this->hasMany(Observaciones::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo');
    }
    public function conceptos()
    {
        return $this->hasOne(Conceptos::class, 'FK_TBL_Encargado_Id', 'PK_NCRD_IdCargo');
    }
    public function usuarios()
    {
        return $this->belongsTo('App\container\Users\src\User', 'FK_Developer_User_Id', 'id');
    }
}
