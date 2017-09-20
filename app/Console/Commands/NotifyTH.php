<?php

namespace App\Console\Commands;

use App\Container\Humtalent\src\StatusOfDocument;
use Illuminate\Console\Command;
use App\Container\Humtalent\src\Event;
use App\Container\Users\src\User;
use App\Container\Permissions\src\Permission;
use App\Container\Permissions\Src\Role;
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
        $permiso = Permission::where('name','FUNC_RRHH')->get(['id'])->first(); //se realiza la consulta del permiso del área de recursos humanos
        $role = Permission::find($permiso->id)->roles()->first()->pivot->role_id;//se realiza la consulta del rol del recurso humano
        $users = Role::find($role)->users()->get(['id'])->first(); //se realiza la consulta del usuario que tiene el permiso consultado
        $user = User::find($users->id);

        if($dia == 5)  //si el día es 5 (viernes) se crea la notificación de documentación completa
        {
            $documentosCompletos = StatusOfDocument::where('EDCMT_Proceso_Documentacion',"Documentación completa EPS")
                                                    ->orWhere('EDCMT_Proceso_Documentacion',"Documentación completa Caja de compensación")->count();
            if($documentosCompletos > 0)
            {
                $data = [
                    'url' => url('siaaf/public/talento-humano/notificaciones/empleadosDocumentosCompletos'), //ruta que muestra la tabla d elos empleados que tienen la doc completa
                    'description' => '¡Empleados con documentos completos!',
                    'image' => 'assets/layouts/layout2/img/avatar3.jpg'
                ];
                $user->notify(new HeaderSiaaf($data)); // se crea la notificación
            }
        }
        if($dia == 3) //si el día es 3 (miercoles) se crea la notificación de documentación incompleta
        {
            $documentosInompletos = StatusOfDocument::where('EDCMT_Proceso_Documentacion',"Documentación incompleta EPS")
                                                 ->orWhere('EDCMT_Proceso_Documentacion',"Documentación incompleta Caja de compensación")->count();
            if($documentosInompletos > 0)
            {
                $data = [
                    'url' => url('siaaf/public/talento-humano/notificaciones/empleadosDocumentosIncompletos'), //ruta que muestra la tabla d elos empleados que tienen la doc incompleta
                    'description' => '¡Empleados con documentos incompletos!',
                    'image' => 'assets/layouts/layout2/img/avatar3.jpg'
                ];
                $user->notify(new HeaderSiaaf($data)); // se crea la notificación
            }
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
                    'url' => url('siaaf/public/talento-humano/calendario/index'), //ruta que muestra el calendario
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
                    'url' => url('siaaf/public/talento-humano/calendario/index'), //ruta que muestra el calendario
                    'description' => '¡Evento pendiente!',
                    'image' => 'assets/layouts/layout2/img/avatar3.jpg'
                ];
                $user->notify(new HeaderSiaaf($data));
            }
        }

        return back()->withInput();
        $this->info('Notificaciones creadas.');

    }
}
