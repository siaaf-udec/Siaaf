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
        return $this->belongsTo(Radicacion::class, 'FK_TBL_Anteproyecto_Id', 'PK_NPRY_IdMinr008');
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
        
    public function scopeSearch($query, $id)
    {
        $query->join('developer.users', 'FK_Developer_User_Id', '=', 'users.id')
            ->join('gesap.tbl_anteproyecto', function ($join) use ($id) {
                $join->on('TBL_encargados.FK_TBL_Anteproyecto_Id', '=', 'PK_NPRY_IdMinr008');
                $join->where('PK_NPRY_IdMinr008', '=', $id);
            })
            ->select('FK_Developer_User_Id AS Cedula', 'PK_NCRD_IdCargo', 'NCRD_Cargo');
    }
}
