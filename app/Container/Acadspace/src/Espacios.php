<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Espacios extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Espacios';

    protected $primaryKey = 'PK_ESP_Id_Espacio';

    protected $fillable = [
        'ESP_Nombre_Espacio'
    ];

    public function aulas()
    {
        return $this->hasMany(Aulas::class, 'FK_SAL_Id_Espacio', 'PK_ESP_Id_Espacio');
    }

    public function incidentes()
    {
        return $this->hasMany(Incidentes::class, 'FK_INC_Id_Espacio', 'PK_ESP_Id_Espacio');
    }

    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'FK_ASIS_Id_Espacio', 'PK_ESP_Id_Espacio');
    }
}
