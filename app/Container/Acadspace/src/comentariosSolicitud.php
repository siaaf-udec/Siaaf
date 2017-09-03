<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class comentariosSolicitud extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_comentariosolicitud';

    protected $primaryKey = 'PK_COM_comentario_solicitud';

    protected $fillable = [
        'COM_comentario',
        'FK_COM_id_solicitud'
    ];

    public function Asistents(){
        return $this->hasMany(Asistent::class);
    }
    public function StatusOfDocuments(){
        return $this->hasMany(StatusOfDocument::class);
    }
    public function Inductions(){
        return $this->hasMany(Induction::class);
    }
    public function Permissions(){
        return $this->hasMany(Permission::class);
    }
    //
}
