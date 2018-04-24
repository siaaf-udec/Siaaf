<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    
     
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    
    protected $connection ='unvinteraction';
      
    /**
     * Conexión de la tabla usada por el modelo
     *
     * @var string
     */
    
    protected $table = 'TBL_Usuario';
     
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */
    
    protected $primaryKey = 'PK_USER_Usuario';
       
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['USER_FK_Users'];
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_Documentacion_Extra
    *por los campo de FK_TBL_Usuario_Id y PK_USER_Usuario
    *para realizar las busquedas complementarias
    */   
    public function usuarioDocumento()
    {
        return $this->hasMany(DocumentacionExtra::class, 'FK_TBL_Usuario_Id', 'PK_USER_Usuario');
    }
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_Notificacion
    *por los campo de FK_TBL_Usuario_Id y PK_USER_Usuario
    *para realizar las busquedas complementarias
    */
    public function usuarioNotificacion()
    {
        return $this->hasMany(Notificacion::class, 'FK_TBL_Usuario_Id', 'PK_USER_Usuario');
    }
    /*
    *Función de conexión entre las tablas de TBL_Usuario y TBL_participante
    *por los campo de FK_TBL_Usuario_Id y PK_USER_Usuario
    *para realizar las busquedas complementarias
    */
    public function usuarioParticipante()
    {
        return $this->hasMany(Participantes::class, 'FK_TBL_Usuario_Id', 'PK_USER_Usuario');
    }
    /*
    *Función de conexión entre las tablas de TBL_Usuario y users
    *por los campo de USER_FK_Users y identity_no
    *para realizar las busquedas complementarias
    */
    public function datoUsuario()
    {
        return $this->belongsTo('App\container\Users\src\User', 'USER_FK_Users', 'identity_no');
        
    }
    
}
