<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class comentariosSolicitud extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_comentariosolicitud';

    protected $primaryKey = 'PK_COM_id_comentario';

    protected $fillable = [
        'COM_comentario',
        'FK_COM_id_solicitud'
    ];

    public function solicitud(){
        return $this->hasOne(Solicitud::class);
    }

    //
}
