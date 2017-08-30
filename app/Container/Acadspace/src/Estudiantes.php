<?php

namespace App\Container\Acadspace\src;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $connection = 'acadspace';

    protected $table = 'tbl_estudiantes';


}
