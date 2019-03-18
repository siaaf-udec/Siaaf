<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PersonaMct extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Detalles_Persona';

    protected $primaryKey = 'PK_Id_Dpersona';

    protected $fillable = [
        'MCT_Detalles_Entidad',
        'MCT_Detalles_Primer_Apellido',
        'MCT_Detalles_Segundo_Apellido',
        'MCT_Detalles_Nombres',
        'MCT_Detalles_Genero',
        'MCT_Detalles_Fecha_Nacimiento',
        'MCT_Detalles_Pais',
        'MCT_Detalles_Correo',
        'MCT_Detalles_Tipo_Doc',
        'MCT_Detalles_Numero',
        'MCT_Detalles_Funcion',
        'MCT_Detalles_Horas_Semanales',
        'MCT_Detalles_Numero_Meses',
        'MCT_Detalles_Tipo_Vinculacion',
        'FK_NPRY_IdMctr008'
    ];
    
}