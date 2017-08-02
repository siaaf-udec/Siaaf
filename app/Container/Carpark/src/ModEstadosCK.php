<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class ModEstadosCK extends Model
{
    protected $connection = 'carpark';

    protected $table = 'TBL_Estados_Parks';

    protected $primaryKey = 'PK__ES_IdEstado';

    protected $fillable = [

      'PK_ES_IdEstado','ES_Estado',
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
}
