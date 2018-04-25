<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
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

    protected $table = 'TBL_Notificacion';
    
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_NTFC_Notificacion';
   
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['NTFC_Titulo','NTFC_Mensaje','NTFC_Bandera','NTFC_Fecha_Vista','FK_TBL_Usuarios_Id'];
    
    /*
    *Función de conexión entre las tablas de TBL_Notificacione y Usuario
    *para realizar las busquedas complementarias
    */ 
    public function usuario(){
        return $this->belongsto(Usuario::class,'FK_TBL_Usuarios_Id','PK_USER_Usuario');;
    }
}
