<?php

namespace App\container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Libro extends Model
{

    protected $connection = 'gesap';

     protected $table = 'tbl_libro';
 
     protected $primaryKey = 'PK_PYT_Libro';
     
     protected $fillable = [
          'PYT_Actividad',
          'PYT_Descripcion',
        //  'FK_Id_Formato'
        ];

/*
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
  */   
 
}