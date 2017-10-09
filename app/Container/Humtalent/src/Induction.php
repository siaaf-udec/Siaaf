<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class Induction extends Model
{

    protected $connection = 'humtalent';

    protected $table = 'TBL_Inducciones';

    protected $primaryKey = 'PK_INDC_ID_Induccion';

    protected $fillable = [
        'INDC_ProcesoInduccion', 'INDC_Aprobacion', 'FK_TBL_Persona_Cedula',
    ];

    public function personas()
    {
        return $this->belongsTo(Persona::class, 'FK_TBL_Persona_Cedula', 'PK_PRSN_Cedula');
    }
    //
}
