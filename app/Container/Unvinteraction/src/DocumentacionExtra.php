<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DocumentacionExtra extends Model
{
    
    use SoftDeletes;
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

    protected $table = 'TBL_Documentacion_Extra';
    
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */

    protected $primaryKey = 'PK_DCET_Documentacion_Extra';
    
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable = ['DCET_Descripcion','DCET_Ubicacion','DCET_Nombre','FK_TBL_Usuarios_Id'];
   
    /*
    *Función de conexión entre las tablas de TBL_Documentacion_Extra y Usuario
    *para realizar las busquedas complementarias
    */     
    public function usuarioDocumento(){
        return $this->belongsto(Usuario::class,'FK_TBL_Usuario_Id','PK_USER_Usuario');
    }
}
