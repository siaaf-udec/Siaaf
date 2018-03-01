<?php

namespace App\Container\Administrative\Src;

use Illuminate\Database\Eloquent\Model;
use App\Container\Administrative\Src\RegistroIngreso;

class Registro extends Model
{
    protected $connection = 'adminis';
    protected $table = 'ingreso';
    protected $primaryKey = 'number_document';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_document', 'username', 'lastname', 'type_user', 'company', 'place', 'number_phone', 'email'
    ];

    //relationships one to many
    public function registroIngreso(){
        return $this->hasMany(RegistroIngreso::class,'id_registro');
    }


}