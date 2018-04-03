<?php

namespace App\Container\AdminRegist\Src;

use App\Container\Administrative\Src\Interfaces\RegistroIngresoInterface;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'novedades';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_novedad'
    ];

    //relationships one to many
    public function novedad(){
        return $this->hasMany(Registros::class,'id_novedad');
    }

    //Traer el total de registros con la novedad correspondiente
    public function getNumNovedadAttribute(){
        return count($this->novedad);
    }




}