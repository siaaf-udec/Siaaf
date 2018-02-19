<?php

namespace App\Container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
  
    public $timestamps = false;
    protected $connection = 'unvinteraction';
    protected $table = 'TBL_Evaluacion';
    protected $primaryKey = 'PK_VLCN_Evaluacion';
    protected $fillable = ['VLCN_Evaluador','VLCN_Evaluado','VLCN_Fecha','FK_TBL_Convenio_Id','VLCN_Tipo_Evaluacion','Nota_Final'];
    
    /*
    *Función de conexión entre las tablas de TBL_Evaluacion y TBL_Convenio
    *por los campo de FK_TBL_Convenios y PK_Convenios
    *para realizar las busquedas complementarias
    */        
     public function conveniosEvaluacion()
    {
        return $this->belongsto(Convenios::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }

    /*
    *Función de conexión entre las tablas de TBL_Evaluacion y TBL_Evaluacion_Preguntas
    *por los campo de FK_TBL_Evaluacion y PK_Evaluacion
    *para realizar las busquedas complementarias
    */    
    public function evaluacionPreguntas()
    {
        return $this->hasMany(EvaluacionPregunta::class, 'FK_TBL_Evaluacion_Id', 'PK_VLCN_Evaluacion');
    }
    
    
    
}
