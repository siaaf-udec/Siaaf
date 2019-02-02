<?php

namespace App\container\Gesap\src;

use Illuminate\Database\Eloquent\Model;

class Mctr008 extends Model
{

    protected $connection = 'gesap';

     protected $table = 'tbl_mctr008';
 
     protected $primaryKey = 'PK_MCT_IdMctr008';
     
     protected $fillable = ['MCT_Actividad', 'MCT_Descripcion'];


     public function relacionCommits()
    {
        return $this->hasMany(Commits::class, 'FK_MCT_IdMctr008', 'PK_MCT_IdMctr008');
    }
     
 
}