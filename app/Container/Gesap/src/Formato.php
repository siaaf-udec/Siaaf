<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Formato extends Model
{
    //modelo del mct para darle formato a las actividades 1=MCT 2=Resultados 3=Libro
    protected $connection = 'gesap';

    protected $table = 'TBL_MCT_Formato';

    protected $primaryKey = 'PK_Id_Formato';

    protected $fillable = [
        'MCT_Formato'
    ];

      
}