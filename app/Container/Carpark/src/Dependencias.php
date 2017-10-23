<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class Dependencias extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Carpark_Dependencias';

    protected $primaryKey = 'PK_CD_IdDependencia';

    protected $fillable = [
        'PK_CD_IdDependencia',
        'CD_Dependencia',
    ];

    public function relacionDependenciaUsuario()
    {
        return $this->belongsTo(Usuarios::class,
            'PK_CD_IdDependencia',
            'FK_CU_IdDependencia'
        );
    }
}
