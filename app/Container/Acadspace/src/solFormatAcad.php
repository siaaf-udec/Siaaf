<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class solFormatAcad extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_solFormAcad';

    protected $primaryKey = 'id_documento';

    protected $fillable = [
        'titulo_doc',
        'descripcion_doc',
        'nombre_doc',
        'id_secretaria',
        'estado'
    ];

    public function setPathAttribute($path){
        $nombre_doc = Carbon::now()->second.$path->getClientOriginalName();
        $this->attributes['nombre_doc'] = $nombre_doc;
        \Storage::disk('local')->put($nombre_doc, \File::get($path));
    }

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
