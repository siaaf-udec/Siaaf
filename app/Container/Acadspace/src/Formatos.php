<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Container\Users\Src\User;

class formatos extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_solFormAcad';

    protected $primaryKey = 'PK_FAC_id_solicitud';

    protected $fillable = [
        'FAC_titulo_doc',
        'FAC_descripcion_doc',
        'FAC_nombre_doc',
        'FK_FAC_id_secretaria',
        'FAC_correo',
        'FAC_estado'
    ];

    public function setFileAttribute($file)
    {
        $nombre_doc = Carbon::now()->second . $file->getClientOriginalName();
        $this->attributes['nombre_doc'] = $nombre_doc;
        \Storage::disk('local')->put($nombre_doc, \File::get($file));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'FK_FAC_id_secretaria');
    }
    //
}
