<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPersona extends Model
{
    protected $connection = 'humtalent';

    protected $table = 'TBL_Documentacion_Personal';

    protected $primaryKey = 'PK_DCMTP_Id_Documento';

    protected $fillable = [
        'DCMTP_Nombre_Documento', 'DCMTP_Tipo_Documento',
    ];


    public function statusOfDocuments()
    {
        return $this->hasMany(StatusOfDocument::class, 'PK_DCMTP_Id_Documento');
    }

    //
}
