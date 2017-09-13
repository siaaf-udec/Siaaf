<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Container\Humtalent\src\Event;
use App\Container\Users\src\User;
use App\Container\Permissions\src\Module;
use App\Container\Permissions\src\Permission;
use App\Container\Humtalent\src\Notification;
use App\Notifications\HeaderSiaaf;
use Carbon\Carbon;

class NotifyTH extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:humTalent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que genera notificaciones para TH';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fecha = getdate(); //se toma la fecha actual
        $dia = $fecha['wday']; //se toma el numero del día
        $permiso = Permission::where('name','FUNC_RRHH')->get(['id']);
        $id=2;
        $user = User::find($id);//Auth::user(); //se verifica el usuario logueado

        if($dia == 5)  //si el día es 5 (viernes) se crea la notificación de documentación completa
        {
            $data = [
                'url' => route('humtalent.empleado.notificaciones.empleadosDocumentosCompletos'), //ruta que muestra la tabla d elos empleados que tienen la doc completa
                'description' => '¡Empleados con documentos completos!',
                'image' => 'assets/layouts/layout2/img/avatar3.jpg'
            ];
            $user->notify(new HeaderSiaaf($data)); // se crea la notificación
        }
        if($dia == 3) { //si el día es 3 (miercoles) se crea la notificación de documentación incompleta
            $data = [
                'url' => route('humtalent.empleado.notificaciones.empleadosDocumentosIncompletos'), //ruta que muestra la tabla d elos empleados que tienen la doc incompleta
                'description' => '¡Empleados con documentos incompletos!',
                'image' => 'assets/layouts/layout2/img/avatar3.jpg'
            ];
            $user->notify(new HeaderSiaaf($data)); // se crea la notificación
        }

        $fechaActual =  Carbon::now();      //se toma la fecha actual
        $fechaActual = $fechaActual->format('Y-m-d');
        $recordatorios = Notification::all(); //se consultan los datos de los recordatorios
        $eventos = Event::all(); //se consultan los datos de los eventos

        foreach ($recordatorios as $recordatorio)
        {
            if($recordatorio['NOTIF_Fecha_Notificacion'] == $fechaActual) //cuando la fecha del recordatorio es igual a la actual se crea la notificación
            {
                $data = [
                    'url' => route('talento.humano.calendario.index'), //ruta que muestra el calendario
                    'description' => '¡Recordatorio pendiente!',
                    'image' => 'assets/layouts/layout2/img/avatar3.jpg'
                ];
                $user->notify(new HeaderSiaaf($data));
            }
        }

        foreach ($eventos as $evento) //se recorren  los datos de los eventos
        {
            if($evento['EVNT_Fecha_Notificacion'] == $fechaActual) // cuando la fecha actual es igual a la de la fecha de notificar el eventos se crea la notificación
            {
                $data = [
                    'url' => route('talento.humano.calendario.index'), //ruta que muestra el calendario
                    'description' => '¡Evento pendiente!',
                    'image' => 'assets/layouts/layout2/img/avatar3.jpg'
                ];
                $user->notify(new HeaderSiaaf($data));
            }
        }

        return back()->withInput();

        $this->info('Prueba....');
    }
}
