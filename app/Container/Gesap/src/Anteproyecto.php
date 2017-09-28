<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Anteproyecto extends Model
{
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
    
}
