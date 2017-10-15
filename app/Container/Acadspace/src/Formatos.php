<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Container\Users\Src\User;

class Formatos extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Formatos';

    protected $primaryKey = 'PK_FAC_Id_Formato';

    protected $fillable = [
        'FAC_Titulo_Doc',
        'FAC_Descripcion_Doc',
        'FAC_Nombre_Doc',
        'FK_FAC_Id_Secretaria',
        'FAC_Correo',
        'FAC_Estado'
    ];

    public function setFileAttribute($file)
    {
        $nombre_doc = Carbon::now()->second . $file->getClientOriginalName();
        $this->attributes['nombre_doc'] = $nombre_doc;
        \Storage::disk('local')->put($nombre_doc, \File::get($file));
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'FK_FAC_Id_Secretaria');
    }
    //
}
