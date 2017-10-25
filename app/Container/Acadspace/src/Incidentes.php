<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Incidentes extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_incidentes';

    protected $primaryKey = 'PK_INC_Id_Incidente';

    protected $fillable = [
        'FK_INC_Id_User',
        'FK_INC_Id_Espacio',
        'INC_Descripcion'
    ];

    public function espacio()
    {
        return $this->hasOne(Espacios::class, 'PK_ESP_Id_Espacio', 'FK_INC_Id_Espacio');
    }

}