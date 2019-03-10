<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Anteproyecto extends Model
{
    
    protected $connection = 'gesap';

    protected $table = 'tbl_anteproyecto';

    protected $primaryKey = 'PK_NPRY_IdMctr008';

    protected $fillable = [
        'NPRY_Titulo'
        ,'NPRY_Keywords'
        ,'NPRY_Descripcion'
        ,'NPRY_Duracion'
        ,'FK_NPRY_Pre_Director'
        ,'FK_NPRY_Estado'
        ,'NPRY_FCH_Radicacion',
    ];

    public function relacionDesarrolladores()
    {
         return $this->hasMany(Desarrolladores::class, 'FK_NPRY_IdMctr008', 'PK_NPRY_IdMctr008');
     }
    public function relacionPredirectores() 
    {
         return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_NPRY_Pre_Director');
     }
   public function relacionEstado()
   {
        return $this->hasOne(EstadoAnteproyecto::class, 'PK_EST_id', 'FK_NPRY_Estado');
    }
    public function relacionCommit()
    {
         return $this->hasMany(Commits::class, 'FK_NPRY_IdMctr008', 'PK_NPRY_IdMctr008');
     }
     public function relacionProyecto()
    {
         return $this->hasone(Proyecto::class, 'FK_NPRY_IdMctr008', 'PK_NPRY_IdMctr008');
     }
    
}