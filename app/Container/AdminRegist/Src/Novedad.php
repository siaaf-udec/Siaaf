<?php

namespace App\Container\AdminRegist\Src;

use App\Container\Administrative\Src\Interfaces\RegistroIngresoInterface;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'TBL_Novedades';
    protected $primaryKey = 'PK_NOV_IdNovedad';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NOV_NombreNovedad'
    ];

    //relationships one to many  de la tabla TBL_Novedades con la tabla TBL_Registros
    public function novedad(){
        return $this->hasMany(Registros::class,'FK_RE_Novedad');
    }

    //Traer el total de registros con la novedad correspondiente
    public function getNumNovedadAttribute(){
        return count($this->novedad);
    }




}