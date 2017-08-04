<?php

namespace App\Container\Carpark\src;

use Illuminate\Database\Eloquent\Model;

class ModMotosCK extends Model
{
      protected $connection = 'carpark';

      protected $table = 'TBL_Motos_Parks';

      protected $primaryKey = 'PK_MT_Placa';

      protected $fillable = [

        'PK_MT_Placa','MT_Marca','MT_Linea','MT_NTpropiedad','MT_Nsoat','MT_FVsoat',
        'FK_MT_Cedula','FK_MT_IdEstado',
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
