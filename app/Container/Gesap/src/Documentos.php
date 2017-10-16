<?php

namespace App\container\gesap\src;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $connection = 'gesap';

    protected $table = 'TBL_Documentos';

    protected $primaryKey = 'PK_DMNT_IdProyecto';

    protected $fillable = ['DMNT_Nombre','DMNT_Descripcion','DMNT_Archivo','FK_TBL_Proyecto_Id'];

    public function proyecto()
    {
        return $this->belongsto(Proyecto::class, 'FK_TBL_Proyecto_Id', 'PK_PRYT_IdProyecto');
    }
}
