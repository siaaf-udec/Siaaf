<?php

namespace App\Container\Acadspace\src;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Container\Users\Src\User;

class Formatos extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     * @var string
     */
    protected $connection = 'acadspace';

    /**
     * Tabla utilizada por el modelo.
     * @var string
     */
    protected $table = 'TBL_Formatos';

    /**
     * Llave primaria usada por el modelo
     */
    protected $primaryKey = 'PK_FAC_Id_Formato';

    /**
     * Atributos que son asignables.
     * @var array
     */
    protected $fillable = [
        'FAC_Titulo_Doc',
        'FAC_Descripcion_Doc',
        'FAC_Nombre_Doc',
        'FK_FAC_Id_Secretaria',
        'FAC_Correo',
        'FAC_Estado'
    ];

    /**
     * Funcion para descargar el formato academico alojado en la ruta     *
     * @param $file
     */
    public function setFileAttribute($file)
    {
        $nombre_doc = Carbon::now()->second . $file->getClientOriginalName();
        $this->attributes['nombre_doc'] = $nombre_doc;
        \Storage::disk('local')->put($nombre_doc, \File::get($file));
    }

    /**
     *  Función que retorna la relación entre la tabla 'TBL_Formatos' y la tabla
     * 'developer.Users' a través de la llave foránea 'FK_FAC_Id_Secretaria'
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'FK_FAC_Id_Secretaria');
    }
    //
}
