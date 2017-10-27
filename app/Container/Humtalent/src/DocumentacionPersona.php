<?php

namespace App\Container\Humtalent\src;

use Illuminate\Database\Eloquent\Model;

class DocumentacionPersona extends Model
{
    /**
     * Conexión de la base de datos usada por el modelo
     *
     * @var string
     */
    protected $connection = 'humtalent';

    /**
     * Tabla utilizada por el modelo.
     *
     * @var string
     */
    protected $table = 'TBL_Documentacion_Personal';

    /**
     * Atributos que son asignables.
     *
     * @var string
     */
    protected $primaryKey = 'PK_DCMTP_Id_Documento';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DCMTP_Nombre_Documento', 'DCMTP_Tipo_Documento',
    ];


    /**
     *  Función que retorna la relación entre la tabla 'tbl_estado_documentacion' y la tabla 'tbl_documentacion_personal'
     *  a través de la llave 'PK_DCMTP_Id_Documento'
     */
    public function statusOfDocuments()
    {
        return $this->hasMany(StatusOfDocument::class, 'PK_DCMTP_Id_Documento');
    }

}
