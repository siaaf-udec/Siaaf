<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Encargados extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Encargados';

    protected $primaryKey = 'PK_NCRD_idCargo';

    protected $fillable = ['FK_TBL_Anteproyecto_id','FK_developer_user_id','NCRD_Cargo'];
    
    
    
    public function anteproyecto() {
        return $this->belongsTo('App\container\gesap\src\Radicacion','FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
    public function observaciones() {
        return $this->hasMany('App\container\gesap\src\Observaciones','FK_TBL_Encargado_id','PK_NCRD_idCargo');
    }
    public function conceptos() {
        return $this->hasOne('App\container\gesap\src\Conceptos','FK_TBL_Encargado_id','PK_NCRD_idCargo');
    }
    public function usuarios() {
        return $this->belongsTo('App\container\Users\src\User','FK_developer_user_id','id');
    }
    
    
    
    public function scopeNombre($query,$cargo) {
        $query->join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
              ->where('NCRD_Cargo',$cargo)
              ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
              ->select(DB::raw('concat(name," ",lastname)'));
    }
    
    public function scopeId($query,$cargo) {
        $query->join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
              ->where('NCRD_Cargo',$cargo)
              ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
              ->select(DB::raw('concat(name," ",lastname)'));
    }
    
    public function scopeSearch($query,$id) {
        $query->join('developer.users','FK_developer_user_id','=','users.id')
            ->join('gesap.tbl_anteproyecto',function ($join) use ($id)
            {    
                $join->on('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');    
                $join->where('PK_NPRY_idMinr008','=',$id);            
            })
            ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NCRD_idCargo','NCRD_Cargo' );
    }
}
