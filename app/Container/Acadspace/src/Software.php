<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'TBL_Software';

    protected $primaryKey = 'PK_SOF_Id';

    protected $fillable = [
        'SOF_Nombre_Soft',
        'SOF_Version',
        'SOF_Licencias'
    ];

}
