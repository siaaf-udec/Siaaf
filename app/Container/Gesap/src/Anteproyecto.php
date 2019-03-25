<?php

namespace App\Container\Gesap\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Anteproyecto extends Model
{
    //este es elmodelado de los anteproyectos de grado
    protected $connection = 'gesap';

    protected $table = 'TBL_Anteproyecto';

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
    //esta es la relacion que tiene el anteproyecto con sus desarrolladores MAX 2
    public function relacionDesarrolladores()
    {
         return $this->hasMany(Desarrolladores::class, 'FK_NPRY_IdMctr008', 'PK_NPRY_IdMctr008');
     }
    //esta es la relacion que tiene el anteproyecto con su predirecor     
    public function relacionPredirectores() 
    {
         return $this->hasOne(Usuarios::class, 'PK_User_Codigo', 'FK_NPRY_Pre_Director');
     }
     //esta es la relacion que dictaen que estado se encuentra el proyecto(7 posibilidades)
   public function relacionEstado()
   {
        return $this->hasOne(EstadoAnteproyecto::class, 'PK_EST_id', 'FK_NPRY_Estado');
    }
    //esta es la relacion que tiene el anteproyecto con las actividades subidas a su nombre
    public function relacionCommit()
    {
         return $this->hasMany(Commits::class, 'FK_NPRY_IdMctr008', 'PK_NPRY_IdMctr008');
     }
     //esta es la relacion final que dictamina si pasa de anteproyecto a proyecto
     public function relacionProyecto()
    {
         return $this->hasone(Proyecto::class, 'FK_NPRY_IdMctr008', 'PK_NPRY_IdMctr008');
     }
    
}