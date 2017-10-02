<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Anteproyecto extends Model
{
    
    use Controllers\traits\traitsGesap;
    protected $connection = 'gesap';

    protected $table = 'TBL_Anteproyecto';

    protected $primaryKey = 'PK_NPRY_idMinr008';

    protected $fillable = ['NPRY_Titulo','NPRY_Keywords','NPRY_Duracion','NPRY_FechaR','NPRY_FechaL','NPRY_Estado'];
    
    public function radicacion() {
        return $this->belongsTo('App\container\gesap\src\Radicacion','FK_TBL_Anteproyecto_id','');
    }
    public function proyecto() {
        return $this->hasOne('App\container\gesap\src\Proyecto','FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
    public function encargados() {
        return $this->hasMany('App\container\gesap\src\Encargados','FK_TBL_Anteproyecto_id','PK_NPRY_idMinr008');
    }
    
    
    public function scopeData($query) {
        $result="NO ASIGNADO";
        $query->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
            ->select('A.*',
                    'R.RDCN_Min',
                    'R.RDCN_Requerimientos',
                    DB::raw('IFNULL(('.$this->getSql(Encargados::Nombre("Director")).'),"'.$result.'")AS Director'),
                    DB::raw('('.$this->getSql(Encargados::Id("Director")).')AS DirectorCedula'),     
                    DB::raw('IFNULL(('.$this->getSql(Encargados::Nombre("Jurado 1")).'),"'.$result.'")AS Jurado1'), 
                    DB::raw('('.$this->getSql(Encargados::Id("Jurado 1")).')AS Jurado1Cedula'),      
                    DB::raw('IFNULL(('.$this->getSql(Encargados::Nombre("Jurado 2")).'),"'.$result.'")AS Jurado2'), 
                    DB::raw('('.$this->getSql(Encargados::Id("Jurado 2")).')AS Jurado2Cedula'), 
                    DB::raw('IFNULL(('.$this->getSql(Encargados::Nombre("Estudiante 1")).'),"'.$result.'")AS estudiante1'),  
                    DB::raw('('.$this->getSql(Encargados::Id("Estudiante 1")).')AS estudiante1Cedula'), 
                    DB::raw('IFNULL(('.$this->getSql(Encargados::Nombre("Estudiante 2")).'),"'.$result.'")AS estudiante2'),  
                    DB::raw('('.$this->getSql(Encargados::Id("Estudiante 2")).')AS estudiante2Cedula')
                );
    }
    
    public function scopeProject($query,$id){
        $query->select('*')
                ->join('gesap.TBL_Radicacion','FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008')
                ->where('PK_NPRY_idMinr008','=',$id);
        
    }
    
    
}
