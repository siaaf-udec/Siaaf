<?php

namespace App\container\Unvinteraction\src;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    /**
     * desactivar opcion de  rellenar casilla update y create date
     *
     * @var string
     */
    public $timestamps    = false;
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
    protected $table      = 'TBL_Convenio';
    /**
     * llave primaria utilizada por el modelo
     *
     * @var string
     */
    protected $primaryKey = 'PK_CVNO_Convenio';
    /**
     * casilla utilizadas en la tabla y el modelo
     *
     * @var string
     */
    protected $fillable   =['CVNO_Nombre','CVNO_Fecha_Inicio','CVNO_Fecha_Fin','FK_TBL_Estado_Id','FK_TBL_Sede_Id'];

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Sedes 
    *por los campo de FK_TBL_Sede y PK_Sede 
    *para realizar las busquedas complementarias
    */
    public function convenioSede()
    {
        return $this->belongsto(Sede::class, 'FK_TBL_Sede_Id', 'PK_SEDE_Sede');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Estado 
    *por los campo de FK_TBL_Estado y PK_Estado 
    *para realizar las busquedas complementarias
    */
    public function convenioEstado()
    {
        return $this->belongsto(Estado::class, 'FK_TBL_Estado_Id', 'PK_ETAD_Estado');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Documentacion 
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */
    public function conveniosDocumentos()
    {
        return $this->hasMany(Documentacion::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Evaluacion 
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */
    public function conveniosEvaluacion()
    {
        return $this->hasMany(Evaluacion::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }
    
    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Empresas_Participante
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */    
    public function conveniosEmpresas()
    {
        return $this->hasMany(Empresas_Participantes::class, 'FK_TBL_Convenio_Id', 'PK_CVNO_Convenio');
    }

    /*
    *Función de conexión entre las tablas de TBL_Convenios y TBL_Participantes
    *por los campo de FK_TBL_Convenios y PK_Convenios 
    *para realizar las busquedas complementarias
    */    
    public function conveniosParticipante()
    {
        return $this->hasMany(Participantes::class, 'FK_TBL_Convenios', 'PK_Convenios');
    }
}
