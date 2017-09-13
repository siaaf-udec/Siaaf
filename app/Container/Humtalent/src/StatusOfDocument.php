<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class StatusOfDocument extends Model
{
    protected $connection = 'humtalent';

    protected $table = 'TBL_Estado_Documentacion';

   // protected $primaryKey = 'PK_DCMTP_Id_Documento';

    protected $fillable = [
        'EDCMT_Fecha','EDCMT_Proceso_Documentacion','FK_TBL_Persona_Cedula','FK_Personal_Documento',
    ];



    public function Personas(){
        return $this->belongsTo(Persona::class,'FK_TBL_Persona_Cedula','PK_PRSN_Cedula');
    }
    public function Notifications(){
        return $this->belongsTo(Notification::class);
    }
    public function DocumentacionPersonas(){
        return $this->belongsTo(DocumentacionPersona::class,'FK_Personal_Documento', 'PK_DCMTP_Id_Documento' );
    }
    //
}
