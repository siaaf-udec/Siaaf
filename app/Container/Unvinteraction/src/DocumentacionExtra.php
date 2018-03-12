<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class DocumentacionExtra extends Model
{
    public $timestamps = false;
    protected $connection ='unvinteraction';
    protected $table = 'TBL_Documentacion_Extra';
    protected $primaryKey = 'PK_DCET_Documentacion_Extra';
    protected $fillable = ['DCET_Descripcion','DCET_Ubicacion','DCET_Entidad','FK_TBL_Usuario_Id'];
   
    /*
    *Función de conexión entre las tablas de TBL_Documentacion_Extra y Usuario
    *para realizar las busquedas complementarias
    */     
    public function usuarioDocumento(){
        return $this->belongsto(Usuario::class,'FK_TBL_Usuario_Id','PK_USER_Usuario');
    }
}
