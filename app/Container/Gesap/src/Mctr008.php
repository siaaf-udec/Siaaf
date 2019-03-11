<?php

namespace App\container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mctr008 extends Model
{

    protected $connection = 'gesap';

     protected $table = 'TBL_Mctr008';
 
     protected $primaryKey = 'PK_MCT_IdMctr008';
     
     protected $fillable = [
          'MCT_Actividad',
          'MCT_Descripcion',
          'FK_Id_Formato'
        ];


     public function relacionCommits()
    {
        return $this->hasMany(Commits::class, 'FK_MCT_IdMctr008', 'PK_MCT_IdMctr008');
    }
    
    public function relacionFormato()
    {
        return $this->hasone(Formato::class, 'PK_Id_Formato', 'FK_Id_Formato');
    }
    public function relacionFormatos()
    {
        return $this->hasmany(Formato::class, 'PK_Id_Formato', 'FK_Id_Formato');
    }
     
 
}