<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Auth;

class Anteproyecto extends Model 
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_Anteproyecto';

    protected $primaryKey = 'PK_NPRY_idMinr008';

    protected $fillable = ['NPRY_Titulo','NPRY_Keywords','NPRY_Duracion','NPRY_FechaR','NPRY_FechaL','NPRY_Estado'];
    
    public function radicacion() {
        return $this->hasOne(Radicacion::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
            ->select('PK_RDCN_idRadicacion','RDCN_Min','RDCN_Requerimientos','FK_TBL_Anteproyecto_id');;
    }
    public function proyecto() {
        return $this->hasOne('App\container\gesap\src\Proyecto','FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
    public function encargados() {
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
    
    public function conceptofinal(){
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
                ->where(function($query)
                {
                    $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                    $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
                })
                ->where('FK_developer_user_id','=',Auth::user()->id)
                ->with(['conceptos']);
    }
    
    public function director() {
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
                ->select("PK_NCRD_idCargo","FK_TBL_Anteproyecto_id","FK_developer_user_id","NCRD_Cargo")
                ->where('NCRD_Cargo','=','Director')
                ->with(['usuarios'=>function($usuarios)
                        {
                            $usuarios->select('name','lastname','id');
                        }]);
    }
    
    public function jurado1() {
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
                ->select("PK_NCRD_idCargo","FK_TBL_Anteproyecto_id","FK_developer_user_id","NCRD_Cargo")
                ->where('NCRD_Cargo','=','Jurado 1')
                ->with(['usuarios'=>function($usuarios)
                        {
                            $usuarios->select('name','lastname','id');
                        }]);
    }
    public function jurado2() {
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
                ->select("PK_NCRD_idCargo","FK_TBL_Anteproyecto_id","FK_developer_user_id","NCRD_Cargo")
                ->where('NCRD_Cargo','=','Jurado 2')
                ->with(['usuarios'=>function($usuarios)
                        {
                            $usuarios->select('name','lastname','id');
                        }]);
    }
    public function estudiante1() {
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
                ->select("PK_NCRD_idCargo","FK_TBL_Anteproyecto_id","FK_developer_user_id","NCRD_Cargo")
                ->where('NCRD_Cargo','=','Estudiante 1')
                ->with(['usuarios'=>function($usuarios)
                        {
                            $usuarios->select('name','lastname','id');
                        }]);
    }
    public function estudiante2() {
        return $this->hasMany(Encargados::class,'FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008')
                ->select("PK_NCRD_idCargo","FK_TBL_Anteproyecto_id","FK_developer_user_id","NCRD_Cargo")
                ->where('NCRD_Cargo','=','Estudiante 2')
                ->with(['usuarios'=>function($usuarios)
                        {
                            $usuarios->select('name','lastname','id');
                        }]);
    }
    
    public function scopeProject($query,$id){ 
        $query->select('*') 
                ->join('gesap.TBL_Radicacion','FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008') 
                ->where('PK_NPRY_idMinr008','=',$id); 
         
    } 
    
    
    
    
}
