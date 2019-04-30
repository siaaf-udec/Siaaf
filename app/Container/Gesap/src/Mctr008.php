<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mctr008 extends Model
{
    //modelo en donde se guardan las actividades de los docuemntos de gesap
    protected $connection = 'gesap';

     protected $table = 'TBL_Mctr008';
 
     protected $primaryKey = 'PK_MCT_IdMctr008';
     
     protected $fillable = [
          'MCT_Actividad',
          'MCT_Descripcion',
          'FK_Id_Formato'
        ];

    //relacion con la cual se relacionan los comentarios guardados a dicha actividad de diferentes proyectos
     public function relacionCommits()
    {
        return $this->hasMany(Commits::class, 'FK_MCT_IdMctr008', 'PK_MCT_IdMctr008');
    }
    //relacion en donde se guarda el formato del docuemnto si mct, requerimientos o Libro
    public function relacionFormato()
    {
        return $this->hasone(Formato::class, 'PK_Id_Formato', 'FK_Id_Formato');
    }
     
 
}