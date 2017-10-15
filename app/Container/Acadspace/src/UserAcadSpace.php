<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserAcadSpace extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_permisos';

    protected $primaryKey = 'PK_PER_id';

    protected $fillable = [
        'FK_PER_Id_User',
        'PER_nombre_espacio'
    ];

    public function user()
    {
        return $this->belongsTo('App\Container\Users\Src\User', 'FK_SOL_Id_Docente');
    }

}