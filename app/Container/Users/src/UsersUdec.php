<?php

namespace App\Container\Users\src;

use App\Container\AdminRegist\Src\Registros;
use Illuminate\Database\Eloquent\Model;
use App\Container\Administrative\Src\RegistroIngreso;

class UsersUdec extends Model
{
    protected $connection = 'developer';
    protected $table = 'users_udec';
    protected $primaryKey = 'number_document';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number_document','code', 'username', 'lastname', 'type_user', 'company', 'place', 'number_phone', 'email'
    ];

    //relationships one to many
    public function registroIngreso(){
        return $this->hasMany(RegistroIngreso::class,'id_registro');
    }

    //relationships one to many
    public function registroAdminRegist(){
        return $this->hasMany(Registros::class,'id_registro');
    }

    /**
     * Get the UsuarioEspaciosAcademicos record associated with the user.
     */
    public function acadspace()
    {
        return $this->hasMany('App\Container\Acadspace\Src\Solicitud', 'SOL_id_docente');
    }

    public function formatosAcadspace()
    {
        return $this->hasMany('App\Container\Acadspace\Src\Formatos', 'FK_FAC_id_secretaria');
    }


}