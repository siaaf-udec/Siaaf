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
   
     public function convenios_Evaluacion()
    {
        return $this->belongsto(TBL_Convenios::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
    public function evaluacion_Preguntas()
    {
        return $this->hasMany(TBL_Evaluacion_Preguntas::class, 'FK_TBL_E<valuacion', 'PK_Evaluacion');
    }
    public function evaluado_E()
    {
        return $this->hasOne(TBL_Empresa::class ,'PK_Empresa','Evaluado' );
    }
    public function evaluado_U()
    {
        return $this->hasOne('App\Container\Users\Src\User', 'identity_no' ,'Evaluado');
    }
    public function evaluador()
    {
        return $this->hasOne('App\Container\Users\Src\User', 'identity_no' ,'Evaluador')->select('name','lastname');
    }
}
