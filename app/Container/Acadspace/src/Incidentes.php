<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Incidentes extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_incidentes';

    protected $primaryKey = 'PK_INC_id_incidente';

    protected $fillable = [
        'FK_INC_id_user',
        'INC_nombre_espacio',
        'INC_descripcion'
    ];

    public function Asistents()
    {
        return $this->hasMany(Asistent::class);
    }

    public function StatusOfDocuments()
    {
        return $this->hasMany(StatusOfDocument::class);
    }

    public function Inductions()
    {
        return $this->hasMany(Induction::class);
    }

    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }
    //
}