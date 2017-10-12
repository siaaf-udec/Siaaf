<?php

namespace App\Container\Acadspace\src;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Docentes extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_docentes';

    protected $primaryKey = 'PK_DOC_id_registro';

    protected $fillable = [
        'FK_DOC_id_docente',
        'DOC_num_est',
        'DOC_sala',
        'DOC_tipo_practica'
    ];
    //
    public function aula(){
        return $this->hasOne(Aulas::class, 'DOC_sala');
    }
}