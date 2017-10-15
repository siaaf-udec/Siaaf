<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Comentarios';

    protected $primaryKey = 'PK_COM_Id_Comentario';

    protected $fillable = [
        'COM_Comentario',
        'FK_COM_Id_Solicitud'
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class,'FK_COM_Id_Solicitud', 'PK_SOL_Id_Solicitud');
    }

    //
}
