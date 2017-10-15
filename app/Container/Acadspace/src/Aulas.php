<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Aulas';

    protected $primaryKey = 'PK_SAL_Id_Sala';

    protected $fillable = [
        'SAL_Nombre_Sala',
        'SAL_Nombre_Espacio'
    ];
    //
    public function docente(){
        return $this->hasOne(Docentes::class);
    }
}