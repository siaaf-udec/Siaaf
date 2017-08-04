<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPersona extends Model
{
    protected $connection = 'humtalent';

    protected $table = 'TBL_Documentacion_Personal';

    protected $primaryKey = 'PK_DCMTP_Id_Documento';

    protected $fillable = [
        'DCMTP_Nombre_Documento',
    ];


    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class,'FK_Personal_Documento');
    }

    //
}
