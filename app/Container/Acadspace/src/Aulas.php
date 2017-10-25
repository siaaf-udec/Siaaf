<?php

namespace App\Container\Acadspace\src;


use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Aulas';

    protected $primaryKey = 'PK_SAL_Id_Sala';

    protected $fillable = [
        'SAL_Nombre_Sala',
        'FK_SAL_Id_Espacio'
    ];
    //
    public function espacio()
    {
        return $this->hasOne(Espacios::class, 'PK_ESP_Id_Espacio', 'FK_SAL_Id_Espacio');
    }

    public function solicitud()
    {
        return $this->hasMany(Solicitud::class, 'FK_SOL_Id_Sala', 'PK_SAL_Id_Sala');
    }

    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'FK_ASIS_Id_Espacio', 'PK_SAL_Id_Sala');
    }
}