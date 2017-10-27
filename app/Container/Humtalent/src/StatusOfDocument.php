<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class StatusOfDocument extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TBL_Estado_Documentacion';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'EDCMT_Fecha', 'EDCMT_Proceso_Documentacion', 'FK_TBL_Persona_Cedula', 'FK_Personal_Documento',
    ];


    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_estado_documentacion'
     *  a través de la llave foránea 'FK_TBL_Persona_Cedula' y la llave 'PK_PRSN_Cedula'
     */
    public function personas()
    {
        return $this->belongsTo(Persona::class, 'FK_TBL_Persona_Cedula', 'PK_PRSN_Cedula');
    }

    /**
     *  Función que retorna la relación entre la tabla 'tbl_documentacion_personal' y la tabla 'tbl_estado_documentacion'
     *  a través de la llave foránea 'FK_Personal_Documento' y la llave 'PK_DCMTP_Id_Documento'
     */
    public function documentacionPersonas()
    {
        return $this->belongsTo(DocumentacionPersona::class, 'FK_Personal_Documento', 'PK_DCMTP_Id_Documento');
    }

}
