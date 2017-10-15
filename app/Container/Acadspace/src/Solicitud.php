<?php

namespace App\Container\Acadspace\src;

use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_solicitud';

    protected $primaryKey = 'PK_SOL_Id_Solicitud';

    protected $fillable = [
        'SOL_Guia_Practica',
        'SOL_Software',
        'SOL_Grupo',
        'SOL_Cant_Estudiantes',
        'FK_SOL_Id_Docente',
        'SOL_Dias',
        'SOL_Hora_Fin',
        'SOL_Hora_Inicio',
        'SOL_Estado',
        'SOL_Nucleo_Tematico',
        'SOL_Id_Practica',
        'FK_SOL_Id_Sala',
        'SOL_Carrera',
        'SOL_Espacio',
        'SOL_Rango_Fechas'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'FK_SOL_Id_Docente');
    }


    public function coment()
    {
        return $this->hasOne(Comentarios::class, 'FK_COM_Id_Solicitud', 'PK_SOL_Id_Solicitud');
    }
    //
}
