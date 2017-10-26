<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class TBL_Evaluacion extends Model
{
  
    public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'TBL_Evaluacion';
    protected $primaryKey = 'PK_Evaluacion';
    protected $fillable = ['Evaluador','Evaluado','FK_TBL_Convenios','Tipo_Evaluacion','Nota_Final'];
    
    /*
    *Función de conexión entre las tablas de TBL_Evaluacion y TBL_Convenio
    *por los campo de FK_TBL_Convenios y PK_Convenios
    *para realizar las busquedas complementarias
    */        
     public function convenios_Evaluacion()
    {
        return $this->belongsto(TBL_Convenios::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }

    /*
    *Función de conexión entre las tablas de TBL_Evaluacion y TBL_Evaluacion_Preguntas
    *por los campo de FK_TBL_E<valuacion y PK_Evaluacion
    *para realizar las busquedas complementarias
    */    
    public function evaluacion_Preguntas()
    {
        return $this->hasMany(TBL_Evaluacion_Preguntas::class, 'FK_TBL_E<valuacion', 'PK_Evaluacion');
    }

    /*
    *Función de conexión entre las tablas de TBL_Evaluacion y TBL_Empresa
    *por los campo de PK_Empresa y Evaluado
    *para realizar las busquedas complementarias
    */     
    public function evaluado_E()
    {
        return $this->hasOne(TBL_Empresa::class ,'PK_Empresa','Evaluado' );
    }

    /*
    *Función de conexión entre la tabla TBL_Evaluacion y la ruta App\Container\Users\Src\User 
    *por los campo de identity_no y Evaluado
    *para realizar las busquedas complementarias
    */ 
    public function evaluado_U()
    {
        return $this->hasOne('App\Container\Users\Src\User', 'identity_no' ,'Evaluado');
    }

    /*
    *Función de conexión entre la tabla TBL_Evaluacion y la ruta App\Container\Users\Src\User 
    *por los campo de identity_no y Evaluado
    *seleccionando los campos name, lastname
    *para realizar las busquedas complementarias
    */ 
    public function evaluador()
    {
        return $this->hasOne('App\Container\Users\Src\User', 'identity_no' ,'Evaluador')->select('name','lastname');
    }
}
