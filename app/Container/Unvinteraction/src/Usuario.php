<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Usuario';
    protected $primaryKey = 'PK_USER_Usuario';
    protected $fillable = ['USER_FK_Users'];
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_Documentacion_Extra
    *por los campo de FK_TBL_Sede y PK_Sede
    *para realizar las busquedas complementarias
    */   
    public function usuarioDocumento()
    {
        return $this->hasMany(DocumentacionExtra::class, 'FK_TBL_Usuario_Id', 'PK_USER_Usuario');
    }
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_Notificacion
    *por los campo de FK_TBL_Sede y PK_Sede
    *para realizar las busquedas complementarias
    */
    public function usuarioNotificacion()
    {
        return $this->hasMany(Notificacion::class, 'FK_TBL_Usuario_Id', 'PK_USER_Usuario');
    }
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_participante
    *por los campo de FK_TBL_Sede y PK_Sede
    *para realizar las busquedas complementarias
    */
    public function usuarioParticipante()
    {
        return $this->hasMany(Participantes::class, 'FK_TBL_Usuario_Id', 'PK_USER_Usuario');
    }
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_participante
    *por los campo de FK_TBL_Sede y PK_Sede
    *para realizar las busquedas complementarias
    */
    public function datoUsuario()
    {
        return $this->belongsTo('App\container\Users\src\User', 'USER_FK_Users', 'identity_no');
        
    }
    
}
