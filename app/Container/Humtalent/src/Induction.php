<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Induction extends Model
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
    protected $table = 'TBL_Inducciones';

    /**
     * The database key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'PK_INDC_ID_Induccion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'INDC_ProcesoInduccion', 'INDC_Aprobacion', 'FK_TBL_Persona_Cedula',
    ];

    /**
     *  Función que retorna la relación entre la tabla 'tbl_personas' y la tabla 'tbl_inducciones'
     *  a través de la llave foránea 'FK_TBL_Persona_Cedula' y la llave 'PK_PRSN_Cedula'
     */
    public function personas()
    {
        return $this->belongsTo(Persona::class, 'FK_TBL_Persona_Cedula', 'PK_PRSN_Cedula');
    }
}
