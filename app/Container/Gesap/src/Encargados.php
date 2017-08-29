<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

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

}
