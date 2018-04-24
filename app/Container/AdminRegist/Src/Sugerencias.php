<?php

namespace App\Container\AdminRegist\Src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sugerencias extends Model
{
    protected $connection = 'adminregist';
    protected $table = 'TBL_Sugerencias';
    protected $primaryKey = 'PK_SU_IdSugerencia';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'SU_Pregunta','SU_Email','SU_Username'
    ];

    use Notifiable;

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'sugerencia-notification.'.'sugerencia';
    }

    public function getNumStatusReadNotificationsAttribute()
    {
        return count($this->unreadNotifications );
    }
}