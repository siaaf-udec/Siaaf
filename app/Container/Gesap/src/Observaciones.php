<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Observaciones extends Model
{
    protected $connection = 'gesap';

    protected $table = 'tbl_observaciones';

    protected $primaryKey = 'PK_BVCS_idObservacion';

    protected $fillable = ['BVCS_Observacion','FK_TBL_Encargado_id'];
    
    public function encargado() {
        return $this->belongsTo('App\container\gesap\src\Encargados','FK_TBL_Encargado_id','PK_NCRD_idCargo');
    }
    public function respuesta() {
        return $this->hasOne('App\container\Users\src\Respuesta','FK_TBL_Observaciones_id','PK_BVCS_idObservacion');
    }
    public function check() {
        return $this->hasOne('App\container\Users\src\Check_Observaciones','FK_TBL_Observaciones_id','PK_BVCS_idObservacion');
    }

    
    public function scopeList($query,$id){
         ->select('PK_BVCS_idObservacion','BVCS_Observacion',
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                            ->join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select(DB::raw('concat(name," ",lastname)'))
                                ->where('gesap.tbl_encargados.PK_NCRD_idCargo','=',DB::raw('O.FK_TBL_Encargado_id'))
                        )
                    .'),"error")AS Jurado'),
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('gesap.tbl_respuesta')
                            ->select('RPST_RMin')
                            ->where('FK_TBL_Observaciones_id','=',DB::raw('O.PK_BVCS_idObservacion'))
                        )
                    .'),"No existe")AS Rmin'),
                     DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('gesap.tbl_respuesta')->
                                select('RPST_Requerimientos')
                                ->where('FK_TBL_Observaciones_id','=',DB::raw('O.PK_BVCS_idObservacion'))
                            )
                    .'),"No existe")AS Rreq')
                )
                ->where('FK_TBL_Anteproyecto_id','=',$id)
                ->where(function($query)
                        {
                            $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                            $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                        })
                ->join('gesap.tbl_encargados','FK_TBL_Encargado_id','=','PK_NCRD_idCargo')
        
    }
}

